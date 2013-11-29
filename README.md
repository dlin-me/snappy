Dlin Symfony Snappy Bundle
=========

Dlin Symfony Snappy Bundle is wrapper bundle for  [Snapy](https://github.com/KnpLabs/snappy) :

>Snappy is a PHP5 library allowing thumbnail, snapshot or PDF generation from a url >or a html page. It uses the excellent webkit-based wkhtmltopdf and wkhtmltoimage >available on OSX, linux, windows.


Dlin Symfony Snappy Bundle provides a configurable service to work with PDF files



Version
-

0.9


***
Installation
--------------


Installation using [Composer](http://getcomposer.org/)

NOTE: Unfortunately, Composer does not support repositories in nested dependencies, we have to include dependencies and repositories in the root composer.json.

Add to your `composer.json`:


    json
    {
        "require" :  {
            ....
            "dlin/snappy-bundle": "dev-master",
            "google/wkhtmltopdf-amd64": "0.11.0-RC1",
            "google/wkhtmltopdf-i386": "0.11.0-RC1",
        },

        ....

        "repositories": [
            {
                "type": "package",
                "package": {
                    "name": "google/wkhtmltopdf-amd64",
                    "version": "0.11.0-RC1",
                    "dist": {
                        "url": "http://wkhtmltopdf.googlecode.com/files/wkhtmltopdf-0.11.0_rc1-static-amd64.tar.bz2",
                        "type": "tar"
                    }
                }
            },
            {
                "type": "package",
                "package": {
                    "name": "google/wkhtmltopdf-i386",
                    "version": "0.11.0-RC1",
                    "dist": {
                        "url": "http://wkhtmltopdf.googlecode.com/files/wkhtmltopdf-0.11.0_rc1-static-i386.tar.bz2",
                        "type": "tar"
                    }
                }
            }
        ]
    }


Enable the bundle in you AppKernel.php


    public function registerBundles()
    {
        $bundles = array(
        ...
        new Dlin\Bundle\SnappyBundle\DlinSnappyBundle(),
        ...
    }


Configuration
--------------

You can specify the installation location of wkhtmltopdf

    #app/config/config.yml

    dlin_snappy:
        pdf_service:
            wkhtmltopdf: /Applications/wkhtmltopdf.app/Contents/MacOS/wkhtmltopdf


For most OS, this bundle will try to download and install the wkhtmltopdf binary itself. No configuration is required unless you want to use a different wkhtmltopdf binary. For Mac servers, one will have to download the DMG file and install it. The above configuration is required.


Usage
--------------

Geting the service in a controller

    $pdf =  $this->get('dlin.pdf_service');

Getting the service in a ContainerAwareService

    $pdf = $this->container->get('dlin.pdf_service');

Using the method "createPdfFromHtml"

    #Pdf will be created (replace if already exist) as file '/tmp/test.pdf'
    $pdf->createPdfFromHtml('<html><body><h1>hello</h1></body>', '/tmp/test.pdf');


Using the method "createPdfFromUrl"

    #Pdf will be created (replace if already exist) as file '/tmp/test.pdf'
    $pdf->createPdfFromUrl('google.com', '/tmp/test.pdf');


Download to browser (HTTP headers will be set and script terminates)

    $pdf->sendHtmlAsPdf('<html><body><h1>hello</h1></body>', 'downloadFileName.pdf');
    #or
    $pdf->sendUrlAsPdf('google.com', 'downloadFileName.pdf');


Show PDF inline in browser (HTTP headers will be set and script terminates)

    $pdf->sendHtmlAsPdf('<html><body><h1>hello</h1></body>', 'downloadFileName.pdf', true);
    #or
    $pdf->sendUrlAsPdf('google.com', 'downloadFileName.pdf', true);


Notes
--------------
* MAMP user couldl have problem using wkhtmltopdf. Please solve the problem [here](http://oneqonea.blogspot.in/2012/04/why-does-wkhtmltopdf-work-via-terminal.html)
* Mac OSX requires its own wkhtmltopdf binnary. You can download it [here](https://code.google.com/p/wkhtmltopdf/downloads/list).
* On your *nix server, you might need to install a library (sudo apt-get install libxrender1)




License
-

MIT

*Free Software, Yeah!*


