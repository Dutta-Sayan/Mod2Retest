<?php

// Including and using necessary files.
require_once "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Fpdf\Fpdf;

/**
 * Class consisting of two functions for sending email to user and genrating
 * a pdf file.
 */
class User
{
  /**
   * @var string
   *  Name of user.
   */
  private $name;

  /**
   * @var string
   *  Email of user.
   */
  private $email;

  /**
   * @var string
   *  Phone number of user.
   */
  private $number;

  /**
   * @var string
   *  Total price of products.
   */
  private $price;

  /**
   * Initialising the class variables.
   * 
   * @param string $name
   *  Name of user.
   * 
   * @param string $email
   *  Email of user.
   * 
   * @param string $number
   *  Phone number of user.
   * 
   * @param string $price
   *  Total price of items.
   */
  public function __construct(string $name, string $email, string $number, string $price)
  {
    $this->name = $name;
    $this->email = $email;
    $this->number = $number;
    $this->price = $price;
  }

  /**
   * Function to create pdf.
   */
  public function createPdf()
  {
    // Fpdf object.
    $pdf = new Fpdf();
    // Adding a page.
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 18);
    $pdf->Cell(0, 10, "USER DETAILS", 0, 1, 'C');
    
    $pdf->Cell(0, 10, "Name: $this->name", 0, 1, 'L');
    $pdf->Cell(0, 10, "Email: $this->email", 0, 1, 'L');
    $pdf->Cell(0, 10, "Mobile No.: $this->number", 0, 1, 'L');
    $pdf->Cell(0, 10, "Price: $$this->price", 0, 1, 'L');
    // Saving the file.
    $pdf->Output("./uploads/$this->name.pdf", 'F');
  }
  
  /**
   * Function to send email to the user.
   * Library used is PHPMailer.
   */
  public function sendEmail()
  {
    // PHPMailer object.
    $newEmail = new PHPMailer();
    try {
      $newEmail->isSMTP();
      $newEmail->Host = 'smtp.gmail.com';
      $newEmail->SMTPAuth = TRUE;
      // Email address from which mail is to be send.
      $newEmail->Username = 'sayan.dutta@innoraft.com';
      $newEmail->Password = 'yyojcrmqcluoqpyz';
      $newEmail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      // Port for sending email.
      $newEmail->Port = 587;
      $newEmail->setFrom('sayan.dutta@innoraft.com', 'Sayan');
      // Contains the user's email address to which mail is to be sent.
      $newEmail->addAddress('shuva.mallick@innoraft.com');
      $newEmail->addReplyTo('sayan.dutta@innoraft.com', 'Sayan');
      $newEmail->isHTML(TRUE);
      // Email contents.
      $newEmail->Subject = 'Checkout Email';
      $newEmail->Body = "<b>Name: <b>$this->name <b>Email: <b>$this->email <b>Phone: <b>$this->number <b>Price: <b>$this->price";
      $newEmail->AltBody = 'Plain Text';
      $newEmail->send();
    }
    catch (Exception $e) {
        echo 'The email cannot be sent'.$newEmail->ErrorInfo;
    }
  }
}

?>