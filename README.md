# evote-movie-2019-15-custom-sql-in-repository

Part of the progressive Movie Voting website project at:
https://github.com/dr-matt-smith/evote-movie-2019

The project has been refactored as follows:

- create a copy of the `templates/list.php` as `listCheap.php` template file with a new `<h1>` saying CHEAP movies:

    ```php
      <?php
      require_once __DIR__ . '/_header.php';
      ?>
      
      
      <!-- start table for displaying DVD details -->
      <h2>Cheap movies !!!</h2>
      
      <table>
          <tr>
              <th> ID </th>
              <th> title </th>
              <th> price </th>
              <th> &nbsp; </th>
              <th> &nbsp; </th>
          </tr>

      ... as in list.php
    ```
      
- add to the Front Controller `/public/index.php` a case where `action=listCheap` invokes the `listCheap()` method of an `MainController` object:

    ```php
          switch ($action){
              case 'about':
                  $mainController->about();
                  break;
              case 'contact':
                  $mainController->contact();
                  break;
              case 'list':
                  $mainController->listMovies();
                  break;
              case 'listCheap':
                  $mainController->listCheapMovies();
                  break;
    ```
        
- add method `listCheap() to the `MainController` class in `/src/MainController.php`:

    ```php
        public function listCheapMovies()
        {
            $movieRepository = new MovieRepository();
            $movies = $movieRepository->getAllCheap();
    
            $pageTitle = 'list';
            $listCheapPageStyle = 'current_page';
            require_once __DIR__ . '/../templates/listCheap.php';
        }
    ```

        
- add our new custom SQL method `getAllCheap() to the `MovieRepository` class in `/src/MovieRepository.php`:

    ```php
          public function getAllCheap()
          {
              $maxPrice = 5;
              $db = new DatabaseManager();
              $connection = $db->getDbh();
      
              $sql = 'SELECT * FROM movie WHERE price < :maxPrice';
      
              $statement = $connection->prepare($sql);
              $statement->bindParam(':maxPrice', $maxPrice, \PDO::PARAM_INT);
              $statement->setFetchMode(\PDO::FETCH_CLASS, $this->getClassNameForDbRecords());
              $statement->execute();
      
              $movies = $statement->fetchAll();
      
              return $movies;
          }
    ```
