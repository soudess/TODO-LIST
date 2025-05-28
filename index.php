
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>TODO LIST</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <h1>To-Do List</h1>
    <hr />
    <form id="TodoForm">
      <div class="input-container">
        <input type="text" placeholder="Ajouter une tâche..." id="todo" name="todo" required />
        <button type="submit">Ajouter</button>
      </div>
    </form>
    <div id="todo_list">

    </div>
    <style>
      div.button{
        display: flex;
        justify-content: space-around;
      }
button {
  padding: 12px 20px;
  background: #4CAF50;
  color: white;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-weight: bold;
  transition: background 0.3s ease;
}

button:hover {
  background: #45a049;
}
    </style>
    <div class="button">
    <button onclick="exporterXML()">Exporter</button>

    <button>Enregistre</button>
    <button>Charger</button>      
    </div>

  </div>

  <script>
    
    window.onload = function () {
      chargerPage();
    };

    
    document.getElementById('TodoForm').addEventListener('submit', function (e) {
      e.preventDefault();
      let todo = document.getElementById('todo').value.trim();

      if (todo === '') {
        alert("Veuillez saisir une tâche !");
        return;
      }

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajouter.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          document.getElementById('todo_list').innerHTML = xhr.responseText;
          document.getElementById('todo').value = "";
        }
      };

      xhr.send("todo=" + encodeURIComponent(todo));
    });

    
    function chargerPage() {
      let xhr = new XMLHttpRequest();
      xhr.open("GET", "ajouter.php", true);

      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          document.getElementById('todo_list').innerHTML = xhr.responseText;
        }
      };

      xhr.send();
    }
    function deleteTodo(id) {
        if (!confirm("Voulez-vous vraiment supprimer cette tâche ?")) return;

        const xhr = new XMLHttpRequest();
        xhr.open("GET", "supprimer.php?id=" + id, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const tache = document.getElementById("tache-" + id);
                if (tache) tache.remove();
            }
        };
        xhr.send();
    }
    function updateTodo(id) {
    const newTodo = prompt("Nouvelle tâche ......");
    if (!newTodo) return; 

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "modification.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // const tache = document.getElementById("tache-" + id).innerHTML= xhr.responseText;
             updateTodo();
        }
    };
    xhr.send("id=" + encodeURIComponent(id) + "&newTodo=" + encodeURIComponent(newTodo));
   }
    function exporterXML() {
      let xhr = new XMLHttpRequest();
      xhr.open("GET", "exporte.php", true);

      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          document.getElementById('todo_list').innerHTML = xhr.responseText;
        }
      };

      xhr.send();
    }
  </script>

</body>
</html>
