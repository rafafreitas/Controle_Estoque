//Primeiro Dropdown caret
$(document).ready(function(){
    $('.drop1').on('show.bs.dropdown', function(){
        $(".dropA1").html('<i class="material-icons">work</i> - Tarefas <span class="dropup"><span class="caret"></span></span>');
    });

    $('.drop1').on('hide.bs.dropdown', function(){
        $(".dropA1").html('<i class="material-icons">work</i> - Tarefas <span class="caret"></span>');
    });
});

//Segundo Dropdown caret
$(document).ready(function(){
    $('.drop2').on('show.bs.dropdown', function(){
        $(".dropA2").html('<i class="material-icons">library_books</i> - Relatórios <span class="dropup"><span class="caret"></span></span>');
    });

    $('.drop2').on('hide.bs.dropdown', function(){
        $(".dropA2").html('<i class="material-icons">library_books</i> - Relatórios <span class="caret"></span>');
    });
});


//Função do "Hamburger" (MÍcone do menu principal)
$(document).ready(function () {
  var trigger = $('.hamburger'),
      overlay = $('.overlay'),
     isClosed = false;

    trigger.click(function () {
      hamburger_cross();      
    });

    function hamburger_cross() {

      if (isClosed == true) {          
        overlay.hide();
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        isClosed = false;
      } else {   
        overlay.show();
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        isClosed = true;
      }
  }
  
  $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
  });  
});