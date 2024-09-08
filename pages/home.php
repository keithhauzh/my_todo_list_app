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

require 'parts/header.php';
 ?>


    
    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <h3 class="card-title mb-3">My Todo List</h3>
        
        <!-- make it if logged in, show log out button and hide login and signup button, as well as making content hide when logged out -->
        <?php if (isset ($_SESSION['loggeduser'])) :?>
          <h4>Welcome back, <?= $_SESSION['loggeduser']['name']; ?></h4>
          <div class="pb-2">
            <a href="/logout">Logout</a>
          </div>
        <?php else :?>
          <div class="pb-2">
            <a href="/login">Login</a>
            <a href="/signup">Signup</a>
          </div>
        <?php endif ;?>
        
        <?php require 'parts/error_box.php'; ?>

        <!-- If user is loggged in, show add task section. Otherwise, hide -->
        <?php if (isset ($_SESSION['loggeduser'])) : ?> 
          <ul class="list-group">
            <?php foreach ($todos as $index => $task) : ?>
              <li
              class="list-group-item d-flex justify-content-between align-items-center"
              >
                <div class="d-flex align-items-center">
                  <!-- Check -->
                  <form action="task/check" method="POST">
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

                  <?php if ($task['completed'] == 1) :?>
                    <span class="ms-2">
                      <del><?= $task["label"]; ?></del>
                    </span>
                  <?php else :?>
                    <span class="ms-2">
                      <?= $task["label"]; ?>
                    </span>
                  <?php endif ;?>

                </div>

                <!-- Delete Button -->
                <form action="task/delete" method="POST" style="margin: 0;">
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
            <form class="d-flex justify-content-between align-items-center" method = "POST" action="/task/add">
              <input
                type="text"
                class="form-control"
                placeholder="Add new task..."
                name = "label_name"
              />
              <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
            </form>
          </div>
        <?php endif ; ?>

      </div>
    </div>

<?php 
  require 'parts/footer.php';
