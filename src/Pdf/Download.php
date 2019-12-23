<?php

namespace Checkitsedo\Esrpaymentslip\Pdf;

use Checkitsedo\Esrpaymentslip;
use EsrpaymentslipHelper;
use Fpdf;
use Illuminate\Http\Request;

class Download
{
    //Ränder in mm
	private $marginTop = 0;
	private $marginLeft = 0;

	//Werte auf dem Einzahlungsschein
	private $ezs_bankName = '';
	private $ezs_bankCity = '';
	private $ezs_bankingAccount = '';
	
	private $ezs_recipientName    = '';
	private $ezs_recipientAddress = '';
	private $ezs_recipientCity    = '';
	private $ezs_bankingCustomerIdentification = '';
	
	private $ezs_payerLine1		  = '';
	private $ezs_payerLine2       = '';
	private $ezs_payerLine3       = '';
	private $ezs_payerLine4       = '';
	private $ezs_payerFullAddress = false;
	
	private $ezs_referenceNumber = '';
	private $ezs_amount = 0;
	private $paymentReason = '';
	
	private $pdf = false;
	private $landscapeOrPortrait = "P";
	private $format = "A4";
	
	private $pathToImage = '/var/www/virtual/checkit/test.senti.lu/public/checkitsedo/images/';
	private $type =  'orange';
	

	/**
	 * Constructor method for this class
	 */
	public function __construct($marginTop=0, $marginLeft=0, $pdfObject=false, $landscapeOrPortrait="P", $format="A4")
	{
		//Sachen einstellen
		$this->marginTop = $marginTop;
		$this->marginLeft = $marginLeft;
		$this->landscapeOrPortrait = $landscapeOrPortrait;
		$this->format = $format;
		
		if($pdfObject != false){
			$this->pdf = $pdfObject;
		}//if
	}
	
	
	/**
	 * Verarbeiten der Eingaben aus dem Formular
	 */
	public function esr($esrpaymentslip)
	{
		//Create a new pdf to create your invoice, already using FPDF
		//(if you don't understand this part you should have a look at the FPDF documentation)
		$pdf = new Fpdf('P','mm','A4');
		Fpdf::AddPage();
		Fpdf::SetAutoPageBreak(0,0);
		Fpdf::SetFont('Helvetica','B',5.975);
		Fpdf::SetTextColor(205,81,56);
		Fpdf::SetXY(4.5, 0);
		Fpdf::Cell(50, 377, utf8_decode("--> Sie können die unten stehenden Daten kopieren und in Ihr e-Banking-Zahlungsformular einfügen. Der folgende Abschnitt kann nicht als Einzahlungsschein am Postschalter verwendet werden. <--"));
		Fpdf::SetTextColor(0,0,0);
		
		//Fügen Sie jetzt einfach Ihren Einzahlungsschein hinzu. Senden Sie Ihre PDF-Instanz an die Klasse Einzahlungsschein
		$ezs = new Download(191, 0, $pdf);
		
		$bankName = $esrpaymentslip->bankName;
		$bankCity = $esrpaymentslip->bankCity;
		$bankingAccount = $esrpaymentslip->bankingAccount;
		$bankingCustomerIdentification = $esrpaymentslip->bankingCustomerIdentification;
		
		$recipientName = $esrpaymentslip->recipientName;
		$recipientAddress = $esrpaymentslip->recipientAddress;
		$recipientCity = $esrpaymentslip->recipientCity;
				
		$payerLine1 = $esrpaymentslip->payerLine1;
		$payerLine2 = $esrpaymentslip->payerLine2;
		$payerLine3 = $esrpaymentslip->payerLine3;
		$payerLine4 = $esrpaymentslip->payerLine4;
		
		$invoiceNumber = $esrpaymentslip->invoiceNumber;
		$referenceNumber = $esrpaymentslip->referenceNumber;
		$amount = $esrpaymentslip->amount;
		
		$ezs->setBankData($bankName, $bankCity, $bankingAccount);
		$ezs->setRecipientData($recipientName, $recipientAddress, $recipientCity, $bankingCustomerIdentification);
		$ezs->setPayerData($payerLine1, $payerLine2, $payerLine3, $payerLine4);
		$ezs->setPaymentData($amount, $referenceNumber);
		$ezs->createEinzahlungsschein(false, true);
		
		Fpdf::output('D', "Einzahlungsschein.pdf", true);
	}
	
	
	//Typ setzen
	public function setType($type)
	{
		$this->type = $type;
	}
	
	
	/**
	 * Set name, address and banking account of bank
	 * @param string $bankName
	 * @param string $bankCity
	 * @param string $bankingAccount
	 * @return bool
	 */
	public function setBankData($bankName, $bankCity, $bankingAccount)
	{
		$this->ezs_bankName = utf8_decode($bankName);
		$this->ezs_bankCity = utf8_decode($bankCity);
		$this->ezs_bankingAccount = $bankingAccount;
		
		return true;
	}
	
	
	/**
	 * Set name and address of recipient of money (= you, I guess)
	 * @param string $recipientName
	 * @param string $recipientAddress
	 * @param string $recipientCity
	 * @param int    $bankingCustomerIdentification
	 * @return bool
	 */
	public function setRecipientData($recipientName, $recipientAddress, $recipientCity, $bankingCustomerIdentification)
	{
		$this->ezs_recipientName    = $recipientName;
		$this->ezs_recipientAddress = $recipientAddress;
		$this->ezs_recipientCity    = $recipientCity;
		$this->ezs_bankingCustomerIdentification = $bankingCustomerIdentification;
		
		return true;
	}
	
	
	/**
	 * Set name and address of payer (very flexible four lines of text)
	 * @param string $payerLine1
	 * @param string $payerLine2
	 * @param string $payerLine3
	 * @param string $payerLine4
	 * @return bool
	 */
	public function setPayerData($payerLine1, $payerLine2, $payerLine3, $payerLine4)
	{
		$this->ezs_payerLine1 = $payerLine1;
		$this->ezs_payerLine2 = $payerLine2;
		$this->ezs_payerLine3 = $payerLine3;
		$this->ezs_payerLine4 = $payerLine4;
		
		return true;
	}
	
	
	/**
	 * Set name and address of payer (very flexible four lines of text)
	 * @param string $payerLine1
	 * @param string $payerLine2
	 * @param string $payerLine3
	 * @param string $payerLine4
	 * @return bool
	 */
	public function setPayerFullAddress($address)
	{
		$this->ezs_payerFullAddress = $address;
		
		return true;
	}
	
	
	/**
	 * Set payment data
	 * @param float $amount
	 * @param int   $referenceNumber (
	 * @return bool
	 */
	public function setPaymentData($amount, $referenceNumber=null)
	{
		$this->ezs_amount 		   = sprintf("%01.2f",$amount);
		$this->ezs_referenceNumber = $referenceNumber;
		
		return true;
	}
	
	
	/**
	 * Set payment reason
	 * @param string $txt
	 * @return bool
	 */
	public function setPaymentReason($txt)
	{
		$this->paymentReason   = utf8_decode($txt);
		
		return true;
	}
	
	
	/**
	 * Does the magic!
	 * @param bool $doOutput
	 * @param string $filename
	 * @param string $saveAction (I, D, F, or S -> see http://www.fpdf.de/funktionsreferenz/?funktion=Output)
	 * @return string or file
	 */
	public function createEinzahlungsschein($doOutput=true, $displayImage=false, $fileName='', $saveAction='')
	{
		//Set basic stuff
		if(!$this->pdf)
		{
			$this->pdf = new Fpdf($this->landscapeOrPortrait,'mm',$this->format);
			$this->pdf->AddPage();
			$this->pdf->SetAutoPageBreak(0);
		}//if
		
		//Place image
		if($displayImage)
		{
			Fpdf::Image($this->pathToImage."ezs_".$this->type.".png", $this->marginLeft, $this->marginTop, 210, 106, "PNG");
		}//if
		
		//Set font
		Fpdf::SetFont('Helvetica','',9);
		
		//Place name of bank (twice)
		Fpdf::SetXY($this->marginLeft+2, $this->marginTop+9);
		Fpdf::Cell(50, 4,$this->ezs_bankName);
		Fpdf::SetXY($this->marginLeft+2, $this->marginTop+13);
		Fpdf::Cell(50, 4,$this->ezs_bankCity);
		
		Fpdf::SetXY($this->marginLeft+62.6, $this->marginTop+9);
		Fpdf::Cell(50, 4,$this->ezs_bankName);
		Fpdf::SetXY($this->marginLeft+62.6, $this->marginTop+13);
		Fpdf::Cell(50, 4,$this->ezs_bankCity);
		
		//Place banking account (twice)
		Fpdf::SetXY($this->marginLeft+27, $this->marginTop+42.75);
		Fpdf::Cell(30, 4,$this->ezs_bankingAccount);

		Fpdf::SetXY($this->marginLeft+87.5, $this->marginTop+42.75);
		Fpdf::Cell(30, 4,$this->ezs_bankingAccount);
		
		//Place money amount (twice)
		if($this->ezs_amount > 0)
		{
			$amountParts = explode(".", $this->ezs_amount);
		} else
		{
			$amountParts[0] = "--";
			$amountParts[1] = "--";
		}//if
		
		$offset = 50.5;
		if($this->type == 'red'){$offset = 51.5;};
		Fpdf::SetFont('Helvetica','',12);
		
		Fpdf::SetXY($this->marginLeft+7, $this->marginTop+$offset+0.7);
		Fpdf::Cell(35, 4,$amountParts[0], 0, 0, "R");
		Fpdf::SetXY($this->marginLeft+48.5, $this->marginTop+$offset+0.7);
		Fpdf::Cell(6, 4,$amountParts[1], 0, 0, "C");
		
		Fpdf::SetXY($this->marginLeft+67.6, $this->marginTop+$offset+0.7);
		Fpdf::Cell(35, 4,$amountParts[0], 0, 0, "R");
		Fpdf::SetXY($this->marginLeft+109.2, $this->marginTop+$offset+0.7);
		Fpdf::Cell(6, 4,$amountParts[1], 0, 0, "C");
		
		//Place name of receiver (twice)
		if($this->type == 'red')
		{
			$this->pdf->SetFont('Helvetica','',9);
			
			$this->pdf->SetXY($this->marginLeft+2, $this->marginTop+23);
			$this->pdf->Cell(50, 4,$this->formatIban(utf8_decode($this->ezs_bankingCustomerIdentification)));
			$this->pdf->SetXY($this->marginLeft+2, $this->marginTop+27);
			$this->pdf->Cell(50, 4,utf8_decode($this->ezs_recipientName));
			$this->pdf->SetXY($this->marginLeft+2, $this->marginTop+31);
			$this->pdf->Cell(50, 4,utf8_decode($this->ezs_recipientAddress));
			$this->pdf->SetXY($this->marginLeft+2, $this->marginTop+35);
			$this->pdf->Cell(50, 4,utf8_decode($this->ezs_recipientCity));
			
			$this->pdf->SetXY($this->marginLeft+62.6, $this->marginTop+23);
			$this->pdf->Cell(50, 4,$this->formatIban(utf8_decode($this->ezs_bankingCustomerIdentification)));
			$this->pdf->SetXY($this->marginLeft+62.6, $this->marginTop+27);
			$this->pdf->Cell(50, 4,utf8_decode($this->ezs_recipientName));
			$this->pdf->SetXY($this->marginLeft+62.6, $this->marginTop+31);
			$this->pdf->Cell(50, 4,utf8_decode($this->ezs_recipientAddress));
			$this->pdf->SetXY($this->marginLeft+62.6, $this->marginTop+35);
			$this->pdf->Cell(50, 4,utf8_decode($this->ezs_recipientCity));
		} else
		{
			Fpdf::SetFont('Helvetica','',9);
			
			Fpdf::SetXY($this->marginLeft+2, $this->marginTop+21.5);
			Fpdf::Cell(50, 4,utf8_decode($this->ezs_recipientName));
			Fpdf::SetXY($this->marginLeft+2, $this->marginTop+25.5);
			Fpdf::Cell(50, 4,utf8_decode($this->ezs_recipientAddress));
			Fpdf::SetXY($this->marginLeft+2, $this->marginTop+29.5);
			Fpdf::Cell(50, 4,utf8_decode($this->ezs_recipientCity));
			
			Fpdf::SetXY($this->marginLeft+62.6, $this->marginTop+21.5);
			Fpdf::Cell(50, 4,utf8_decode($this->ezs_recipientName));
			Fpdf::SetXY($this->marginLeft+62.6, $this->marginTop+25.5);
			Fpdf::Cell(50, 4,utf8_decode($this->ezs_recipientAddress));
			Fpdf::SetXY($this->marginLeft+62.6, $this->marginTop+29.5);
			Fpdf::Cell(50, 4,utf8_decode($this->ezs_recipientCity));
		}
		
		//Place name of Payer (twice)	
		if($this->ezs_payerFullAddress)
		{
			$this->pdf->SetXY($this->marginLeft+2, $this->marginTop+64);
			$this->pdf->MultiCell(50, 4, utf8_decode($this->ezs_payerFullAddress), 0, 'L');
			
			$this->pdf->SetXY($this->marginLeft+123, $this->marginTop+48);
			$this->pdf->MultiCell(50, 4, utf8_decode($this->ezs_payerFullAddress), 0, 'L');
		} else
		{
			Fpdf::SetXY($this->marginLeft+2, $this->marginTop+66);
			Fpdf::Cell(50, 4,utf8_decode($this->ezs_payerLine1));
			Fpdf::SetXY($this->marginLeft+2, $this->marginTop+70);
			Fpdf::Cell(50, 4,utf8_decode($this->ezs_payerLine2));
			Fpdf::SetXY($this->marginLeft+2, $this->marginTop+74);
			Fpdf::Cell(50, 4,utf8_decode($this->ezs_payerLine3));
			Fpdf::SetXY($this->marginLeft+2, $this->marginTop+78);
			Fpdf::Cell(50, 4,utf8_decode($this->ezs_payerLine4));
			
			Fpdf::SetXY($this->marginLeft+123.2, $this->marginTop+47);
			Fpdf::Cell(50, 4,utf8_decode($this->ezs_payerLine1));
			Fpdf::SetXY($this->marginLeft+123.2, $this->marginTop+51);
			Fpdf::Cell(50, 4,utf8_decode($this->ezs_payerLine2));
			Fpdf::SetXY($this->marginLeft+123.2, $this->marginTop+55);
			Fpdf::Cell(50, 4,utf8_decode($this->ezs_payerLine3));
			Fpdf::SetXY($this->marginLeft+123.2, $this->marginTop+59);
			Fpdf::Cell(50, 4,utf8_decode($this->ezs_payerLine4));
		}
		
		//Reference number
		if($this->type == 'orange')
		{
			//create complete reference number
			$completeReferenceNumber = $this->createCompleteReferenceNumber();
			
			//Place Reference Number (twice)
			Fpdf::SetFont('Helvetica','',10);
			Fpdf::SetXY($this->marginLeft+125, $this->marginTop+34.25);
			Fpdf::Cell(80, 4, $this->breakStringIntoBlocks($completeReferenceNumber));
			
			Fpdf::SetFont('Helvetica','',7);
			Fpdf::SetXY($this->marginLeft+2, $this->marginTop+60);
			Fpdf::Cell(50, 4, $this->breakStringIntoBlocks($completeReferenceNumber));
		}//if
		
		//Payment reason
		if($this->type == 'red')
		{
			$this->pdf->SetXY($this->marginLeft+125, $this->marginTop+12);
			$this->pdf->MultiCell(50, 4, $this->paymentReason, 0, 'L');
		}//if
		
		//Bottom line
		if($this->type == 'orange')
		{
			//create bottom line string
			$bottomLineString = '';
			
			//ESR with amount or not?
			if($this->ezs_amount == 0)
			{
				$bottomLineString .= "042>";
			} else
			{
				$amountParts = explode(".", $this->ezs_amount);
				$bottomLineString .= "01";
				$bottomLineString .= str_pad($amountParts[0], 8 ,'0', STR_PAD_LEFT);
				$bottomLineString .= str_pad($amountParts[1], 2 ,'0', STR_PAD_RIGHT);
				$bottomLineString .= $this->modulo10($bottomLineString);
				$bottomLineString .= ">";
			}//if
			
			//add reference number
			$bottomLineString .= $this->createCompleteReferenceNumber();
			$bottomLineString .= "+ ";
			
			//add banking account
			$bankingAccountParts = explode("-", $this->ezs_bankingAccount);
			$bottomLineString .= str_pad($bankingAccountParts[0], 2 ,'0', STR_PAD_LEFT);
			$bottomLineString .= str_pad($bankingAccountParts[1], 6 ,'0', STR_PAD_LEFT);
			$bottomLineString .= str_pad($bankingAccountParts[2], 1 ,'0', STR_PAD_LEFT);
			$bottomLineString .= ">";
			
			//Set bottom line
			Fpdf::AddFont('OCRB10');
			Fpdf::SetFont('OCRB10','',10);
			Fpdf::SetXY($this->marginLeft+63, $this->marginTop+85);
			Fpdf::Cell(140,4,$bottomLineString, 0, 0, "R");
		} else
		{
			//set font
			Fpdf::AddFont('OCRB10');
			Fpdf::SetFont('OCRB10','',10);
			
			//add banking account
			$bottomLineString = '';
			$bottomLineString .= str_pad(substr($this->ezs_bankingCustomerIdentification, 8), 26 ,'0', STR_PAD_LEFT);
			$bottomLineString .= $this->modulo10($bottomLineString);
			$bottomLineString .= "+";
			
			$bottomLineString2 = '';
			$bcNummer = substr($this->ezs_bankingCustomerIdentification, 4, 5);
			$bottomLineString2 .= " 07".$bcNummer;
			$bottomLineString2 .= $this->modulo10($bcNummer);
			$bottomLineString2 .= $this->modulo10($bottomLineString2);
			$bottomLineString2 .= ">";
			$bottomLineString  .= $bottomLineString2;
			
			//Set bottom line
			Fpdf::SetXY($this->marginLeft+67, $this->marginTop+85);
			Fpdf::Cell(140,4,$bottomLineString, 0, 0, "R");
			
			//add banking account
			$bottomLineString = '';
			$bankingAccountParts = explode("-", $this->ezs_bankingAccount);
			$bottomLineString .= str_pad($bankingAccountParts[0], 2 ,'0', STR_PAD_LEFT);
			$bottomLineString .= str_pad($bankingAccountParts[1], 6 ,'0', STR_PAD_LEFT);
			$bottomLineString .= str_pad($bankingAccountParts[2], 1 ,'0', STR_PAD_LEFT);
			$bottomLineString .= ">";
			
			//Set bottom line
			Fpdf::SetXY($this->marginLeft+67, $this->marginTop+92);
			Fpdf::Cell(140,4,$bottomLineString, 0, 0, "R");
		}//if
		
		//Output
		if($doOutput)
		{
			Fpdf::Output($fileName, $saveAction);
			if($fileName != '')
			{
				return $fileName;
			}//if
		}//if
	}
	
	
	/**
	 * Creates Modulo10 recursive check digit
	 *
	 * as found on http://www.developers-guide.net/forums/5431,modulo10-rekursiv
	 * (thanks, dude!)
	 *
	 * @param string $number
	 * @return int
	 */
	private function modulo10($number)
	{
		$table = array(0,9,4,6,8,2,7,1,3,5);
		$next = 0;
		for ($i=0; $i<strlen($number); $i++)
		{
			$next = $table[($next + substr($number, $i, 1)) % 10];
		}//for
		
		return (10 - $next) % 10;
	}
	
	
	/**
	 * Creates complete reference number
	 * @return string
	 */
	private function createCompleteReferenceNumber()
	{
		//get reference number and fill with zeros
		$completeReferenceNumber = str_pad($this->ezs_referenceNumber, (26 - strlen($this->ezs_bankingCustomerIdentification)) ,'0', STR_PAD_LEFT);
		
		//add customer identification code
		$completeReferenceNumber = $this->ezs_bankingCustomerIdentification.$completeReferenceNumber;
		
		//add check digit
		$completeReferenceNumber .= $this->modulo10($completeReferenceNumber);
		
		//return
		return $completeReferenceNumber;
	}
	
	
	/**
	 * Displays a string in blocks of a certain size.
	 * Example: 00000000000000000000 becomes more readable 00000 00000 00000
	 * @param string $string
	 * @param int $blocksize
	 * @return string
	 */
	private function breakStringIntoBlocks($string, $blocksize=5, $alignFromRight=true)
	{
		//lets reverse the string (because we want the block to be aligned from the right)
		if($alignFromRight)
		{
			$string = strrev($string);
		}//if
		
		//chop it into blocks
		$string = trim(chunk_split($string, $blocksize, ' '));
		
		//re-reverse
		if($alignFromRight)
		{
			$string = strrev($string);
		}//if
		
		return $string;
	}
	
	
	/**
	 * Formats IBAN number in human readable format
	 * @return string
	 */
	private function formatIban($iban)
	{
		return $this->breakStringIntoBlocks($iban, 4, false);
	}
}