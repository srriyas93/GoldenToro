/*--- Export to PDF ---*/
function doExportPDF()
{
  $('.tblexport').tableExport({type: 'pdf',
    jspdf: {
        autotable: {
            styles: {overflow: 'linebreak',
                 fontSize: 6,
                 rowHeight: 8},
            headerStyles: {rowHeight: 8,
                 fontSize: 6},
            bodyStyles: {rowHeight: 8}
          }}});
}

/*--- Export to Excel ---*/
function doExportExcel()
{
  $('.tblexport').tableExport({type:'excel',
      mso: {
        styles: ['background-color',
                 'color',
                 'font-family',
                 'font-size',
                 'font-weight',
                 'text-align']
      }
    }
  );
}

/*--- Export to Excel ---*/
function doExportPNG()
{
  $('.tblexport').tableExport({type:'png'});
}
