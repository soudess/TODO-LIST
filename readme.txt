    function fetchTodos() {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajouter.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          document.getElementById('todo_list').innerHTML = xhr.responseText;
        }
      };

      xhr.send();
    }
        // Chargement initial des tâches
    window.onload = function () {
      fetchTodos();
    };
 <script>
         function delete(<?= $todo['id'] ?>) {
            if (!confirm("Voulez-vous vraiment supprimer cette tâche ?")) return;

            let xhr = new XMLHttpRequest();
            xhr.open("GET", "Ajouter.php", true);

            xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('todo_list').innerHTML = xhr.responseText;
              }
            };

          xhr.send("id=" + id);
      }
    </script>