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

use Dlin\Bundle\SnappyBundle\Service\PdfService;

class PdfServiceTest extends \PHPUnit_Framework_TestCase {



    protected $testFile;


    /**
     * {@inheritDoc}
     */
    public function setUp()
    {


        $this->testFile = '/tmp/test.pdf';
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        @unlink($this->testFile);
    }

    /**
     * Simple test
     */
    public function testPdfFromURL(){
        $pdf = new PdfService('/Applications/wkhtmltopdf.app/Contents/MacOS/wkhtmltopdf');

        $pdf ->createPdfFromURL('http://google.com', $this->testFile);

        $this->assertTrue(file_exists($this->testFile));
    }


    public function testGetVenPath(){


        $this->assertEquals('/test/path/vendor', PdfService::getVendorPath('/test/path/vendor/yes/ok.html'));
        $this->assertNull(  PdfService::getVendorPath('/test/path/vedor/yes/ok.html'));

    }

}