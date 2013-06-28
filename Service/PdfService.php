<?php
/**
 * Created by David Lin
 * Project: snappy
 * Email: david.lin@estimateone.com
 * User: davidlin
 * Date: 27/06/13
 * Time: 3:17 PM
 *
 */


namespace Dlin\Bundle\SnappyBundle\Service;


use Knp\Snappy\Pdf;
use Symfony\Component\HttpFoundation\Response;


class PdfService
{
    /**
     * @var \Knp\Snappy\Pdf
     */
    protected $pdf;


    protected $wkhtmltopdf;

    /**
     * Constructor
     *
     * @inheritdoc
     */
    function __construct($wkhtmltopdf = null)
    {
        if ($wkhtmltopdf === null) {
            $class = new Response();
            $object = new \ReflectionObject($class);
            $path = $object->getFileName();
            $vendorDir = substr($path, 0,
                strpos($path, DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'symfony' . DIRECTORY_SEPARATOR)
            ) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR;

            $os = php_uname('m') == 'x86_64' ? 'amd64' : 'i386';
            $this->wkhtmltopdf = $vendorDir . "google" . DIRECTORY_SEPARATOR . "wkhtmltopdf-$os" . DIRECTORY_SEPARATOR . "wkhtmltopdf-$os";

        }else{

            $this->wkhtmltopdf = $wkhtmltopdf;
        }

        $this->pdf = new Pdf($this->wkhtmltopdf );

    }



    /**
     * Create PDF from HTML string
     * @param $html
     * @param $fileName
     */
    public function createPdfFromHtml($html, $fileName)
    {
        $this->pdf->generateFromHtml($html, $fileName, array(), true); //override existing
    }


    /**
     * Create PDF from a URL address
     * @param $url
     * @param $fileName
     */
    public function createPdfFromUrl($url, $fileName)
    {

        $html = file_get_contents($url);
        $this->pdf->generateFromHtml($html, $fileName);
    }

    /**
     * Create PDF from HTML string and sent to the browser
     *
     * @param $html
     */
    public function sendHtmlAsPdf($html, $fileName)
    {
        header('Content-Type: application/pdf');
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Transfer-Encoding: binary');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');

        echo $this->pdf->getOutputFromHtml($html);

        exit;
    }


    /**
     * Create PDF from a URL and sent to the browser
     *
     * @param $html
     */
    public function sendUrlAsPdf($url, $fileName)
    {
        header('Content-Type: application/pdf');
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Transfer-Encoding: binary');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');

        echo $this->pdf->getOutput($url);
        exit;
    }


}