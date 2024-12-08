function addfriends() {
    let name = document.getElementById("username").value;
    let tel = document.getElementById("tel").value;
    window.location.href = 'homepage.php';
    let userfriend = document.getElementById("userfriend");
    let telefriend = document.getElementById("telefriend");
    userfriend.innerHTML = name;
    telefriend.innerHTML = tel;
}