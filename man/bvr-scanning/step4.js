var nodeUtil = require("util"),
    PFParser = require("pdf2json")
;

var pdfParser = new PFParser();

pdfParser.on("pdfParser_dataReady", function(data) {
  var text = data.data.Pages[0].Texts.map(function(t) {
    return t.R[0].T
  })
  console.log(text.join(' '))
  console.log('here');
  console.log(data);
  console.log(data.data.Pages[0]);
});

pdfParser.on("pdfParser_dataError", function(error) {
  console.error(error);
});

var pdfFilePath = "sample.pdf";

pdfParser.loadPDF(pdfFilePath);
