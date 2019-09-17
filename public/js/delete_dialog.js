var btns = document.getElementsByClassName('app-js-delete-btn');
for (i=0; i < btns.length; i++) {
    btns[i].addEventListener('click', function(e) {
        e.preventDefault();
        if (confirm('Are you sure you want to delete?')) {
            document.getElementById(this.getAttribute('data-delete-form-id')).submit();
        }
    }, false);
}
