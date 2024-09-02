<!-- connecting database -->
 <?php 
 
  $host = "localhost";
  $database_name = "my_todo_list_app";
  $database_user = "root";
  $database_password = "mysql";

  $database = new PDO (
    "mysql:host=$host;dbname=$database_name",
    $database_user, //username
    $database_password //password
  );

  $sql = "SELECT * FROM todos";
  $query = $database->prepare($sql);
  $query->execute();
  $todos = $query->fetchAll();
;
 ?>


<!DOCTYPE html>
<html>
  <head>
    <title>TODO App</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <style type="text/css">
      body {
        background: #f1f1f1;
      }
    </style>
  </head>
  <body>
    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <h3 class="card-title mb-3">My Todo List</h3>
        <ul class="list-group">

          <?php foreach ($todos as $index => $task) : ?>
            <li
            class="list-group-item d-flex justify-content-between align-items-center"
            >
              <div class="d-flex align-items-center">
                <!-- Check -->
                <form action="/check.php" method="POST">
                  <input type="hidden" name="id" value="<?= $task['id']; ?>">
                  <input type="hidden" name="completed" value="<?= $task['completed'];?>">

                  <?php if ($task['completed'] == 1) :?>
                    <button class="btn btn-sm btn-success">
                      <i class="bi bi-check-square"></i>
                    </button>
                  <?php else :?>
                    <button class="btn btn-sm">
                      <i class="bi bi-square"></i>
                    </button>
                  <?php endif ;?>

                  
                </form>

                <span class="ms-2">
                  <?= $task["label"]; ?>
                </span>
              </div>

              <!-- Delete Button -->
              <form action="/delete.php" method="POST" style="margin: 0;">
                    <!-- value="= $task"['id']; "> is to dynamically set the value of the input field which is inside the form field to be the $task['id'], which is the id of the selected task that is to be deleted -->
                    <input type="hidden" name="id" value="<?= $task['id']; ?>">
                    <button class="btn btn-sm btn-danger" type="submit">
                        <i class="bi bi-trash"></i>
                    </button>
              </form>
            </li>
          <?php endforeach; ?>
          
        </ul>
        <div class="mt-4">
          <form class="d-flex justify-content-between align-items-center" method = "POST" action="/add_task.php">
            <input
              type="text"
              class="form-control"
              placeholder="Add new task..."
              name = "label_name"
            />
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
