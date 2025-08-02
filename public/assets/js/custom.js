  window.addEventListener('scroll', function () {
    const header = document.querySelector('.header-container');
    if (window.scrollY > 0) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  });


  document.getElementById('menuToggle').addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('active');
  });
  document.getElementById('closeMenu').addEventListener('click', function () {
    document.getElementById('sidebar').classList.remove('active');
  });

  function userPanelToggle(element)
  {
   const box = document.getElementById('userPanelBox');
      box.classList.toggle('d-none');
  }
  function toggleCollapseButton(element)
  {
    if(element.classList.contains('bi-dash-circle-fill')){
      element.classList.remove('bi-dash-circle-fill');
      element.classList.add('bi-plus-circle-fill');
    }
    else{
      element.classList.remove('bi-plus-circle-fill');
      element.classList.add('bi-dash-circle-fill');
    }
  }

  function toggleCollapseButtonMenu(element)
  {
    const collapseButton = document.getElementById(element.id+"-collapse-button");
    
    if(collapseButton.classList.contains('bi-dash-circle-fill')){
      collapseButton.classList.remove('bi-dash-circle-fill');
      collapseButton.classList.add('bi-plus-circle-fill');
    }
    else{
      collapseButton.classList.remove('bi-plus-circle-fill');
      collapseButton.classList.add('bi-dash-circle-fill');
    }
  }

  function toggleConfirmation(){
    confirmation = document.getElementById("confirmation");
    confirmButton = document.getElementById("final-submit");

    confirmButton.disabled = !confirmation.checked;
  }
  
