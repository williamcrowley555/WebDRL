function exportToWord(htmlContent, fileName) {
  var header =
    "<html xmlns:o='urn:schemas-microsoft-com:office:office' " +
    "xmlns:w='urn:schemas-microsoft-com:office:word' " +
    "xmlns='http://www.w3.org/TR/REC-html40'>" +
    "<head><meta charset='utf-8'><style>* {'Times New Roman', Times, serif}</style></head><body>";
  var footer = "</body></html>";
  var sourceHTML = header + htmlContent + footer;

  var source =
    "data:application/vnd.ms-word;charset=utf-8," +
    encodeURIComponent(sourceHTML);
  var fileDownload = document.createElement("a");
  document.body.appendChild(fileDownload);
  fileDownload.href = source;
  fileDownload.download = `${fileName}.doc`;
  fileDownload.click();
  document.body.removeChild(fileDownload);
}
