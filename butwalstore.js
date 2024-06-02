function redirectToLogin() {
  window.location.href = "http://localhost/Collage_project/login/login07.php";
}
/* this id the code of search bar and fetch the reasult by narayan bogati */
function handleKeyPress(event) {
    if (event.key === 'Enter') {
      searchItem();
    }
  }

  function searchItem() {
    var searchTerm = document.getElementById('searchInput').value.toLowerCase();

    if (searchTerm === 'mobile') {
      window.location.href = 'mobile_search/index.html';
}


else if (searchTerm === 'bike') {
      window.location.href = 'Bike/index.html';

}
      else if (searchTerm === 'login.html') {
        window.location.href = 'login/login.html';

    }
    
    
    else if (searchTerm === 'whatiscomputer') {
    alert('This is working');
    console.losg("this is the electrical component which is use to perform mathmatical and logical task");
  }
  
    
    else {
      alert('Item not found');
    }
  }


  