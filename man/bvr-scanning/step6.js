// vim: nu et tw=130 ts=8 sts=4 sw=4 ff=unix fo-=l fo+=tcroq2 fdm=marker fmr=@{,@}
var utf8 = require('utf8');

// Get the dependencies that have already been installed
// to ./node_modules with `npm install <dep>`in the root director
// of your app

var _ = require('underscore'),
    PDFParser = require('pdf2json');

var pdfParser = new PDFParser();

// Create a function to handle the pdf once it has been parsed. In this case we cycle through all the pages and extraxt all the
// text blocks and print them to console. If you do `console.log(JSON.stringify(pdf))` you will see how the parsed pdf is
// composed. Drill down into it to find the data you are looking for.

var _onPDFBinDataReady = function (pdf) {

    // console.log(JSON.stringify(pdf.formImage.Pages[0].Texts));

    for (var pnum in pdf.formImage.Pages) {

        var page = pdf.formImage.Pages[pnum];
        var prev = null
        var text = ""

        for (var tnum in page.Texts) {

            var tobj = page.Texts[tnum];

            if (prev) {
                if (Math.abs(tobj.y - prev.y) <= 0) {
                    if (Math.abs(tobj.x - prev.x) > 1) prev.R[0].T += " ";
                    prev.R[0].T += tobj.R[0].T;

                }
                else {
                    text += prev.R[0].S  + "\r\n";
                    prev = tobj;
                }
            }
            else prev = tobj;

            if (prev) text += tobj.R[0].T;

        }

        console.log (decodeURI (text.toString('utf8')));
    }

};

// Create an error handling function
var _onPDFBinDataError = function (error) {
  console.log(error);
};

// Use underscore to bind the data ready function to the pdfParser so that when the data ready event is emitted your function
// will be called. As opposed to the example, I have used `this` instead of `self` since self had no meaning in this context.
pdfParser.on('pdfParser_dataReady', _.bind(_onPDFBinDataReady, this));

// Register error handling function
pdfParser.on('pdfParser_dataError', _.bind(_onPDFBinDataError, this));

// Construct the file path of the pdf
var pdfFilePath = 'sample.pdf';

// Load the pdf. When it is loaded your data ready function will be called.
pdfParser.loadPDF(pdfFilePath);
