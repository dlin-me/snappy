<?php
/**
 * Created by David Lin
 * Project: snappy
 * Email: david.lin@estimateone.com
 * User: davidlin
 * Date: 27/06/13
 * Time: 3:39 PM
 * 
 */
namespace Dlin\Snappy\Tests\Service;

use Dlin\Snappy\Service\PdfService;

class PdfServiceTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var \Dlin\Snappy\Service\PdfService
     */
    protected $pdf;

    protected $testFile;


    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        $this->pdf = new PdfService('/Applications/wkhtmltopdf.app/Contents/MacOS/wkhtmltopdf');

        $this->testFile = '/tmp/test.pdf';
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
        $this->pdf = null;
        unlink($this->testFile);

    }

    /**
     * Simple test
     */
    public function testPdfFromURL(){

        $this->pdf->createPdfFromURL('http://google.com', $this->testFile);

        $this->assertTrue(file_exists($this->testFile));
    }

}