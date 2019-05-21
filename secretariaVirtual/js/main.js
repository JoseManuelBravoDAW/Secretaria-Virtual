{
    function init() {
        let todos = document.getElementById("todos");

        todos.addEventListener("click", function () {
            toggle(this);
        });
    }

    function toggle(source) {
        checkboxes = document.getElementsByName('arrayDeUsuarios[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
          checkboxes[i].checked = source.checked;
        }
      }

    document.addEventListener("DOMContentLoaded", init);
}