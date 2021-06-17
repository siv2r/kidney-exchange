$(document).ready(function() {

  console.log("Sucessful");

  $("td").hover(function() {

    console.log("fired");

    $el = $(this);
    
    $el.parent().addClass("hover");

    if ($el.parent().has('td[rowspan]').length == 0)
      
      $el
        .parent()
        .prevAll('tr:has(td[rowspan]):first')
        .find('td[rowspan]')
        .addClass("hover");

  }, function() { 
        
    $el
      .parent()
      .removeClass("hover")
      .prevAll('tr:has(td[rowspan]):first')
      .find('td[rowspan]')
      .removeClass("hover");

  });

});
