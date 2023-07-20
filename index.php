<?php include "partials/_header.php" ?>
<?php include_once "partials/_dbconnection.php" ?>


<!-- CARAOUSEL  -->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://source.unsplash.com/5Xwaj9gaR0g/1600x450" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/m_HRfLhgABo/1600x450" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/vXInUOv1n84/1600x450" class="d-block w-100" alt="...">

    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<!-- BROWSE CATAGORIES  -->
<div class="container">
  <h1 class="text-center text-light">Browse Categories</h1>
  <div class="container row d-flex justify-content-between">
    <?php
    $query = mysqli_query($connection, "SELECT * FROM categories");
    while ($assoc_data = mysqli_fetch_assoc($query)) {
      $category_id = $assoc_data['category_id'];
      $category_name = $assoc_data['category_name'];
      $category_description = $assoc_data['category_description'];

      echo ('<div class="card m-3 border border-success bg_2" style="width: 18rem; height: 21rem;">
                <div class="container-fluid text-center mt-2">
                  <img src="images/Logo_' . $category_id . '.png" class="" width="130px" height="100px" alt="...">
                </div>                
                <div class="card-body">
                  <h5 class="card-title">' . $category_name . '</h5>
                  <p class="card-text">' . substr($category_description, 0, 100) . '...</p>
                  <a href="/pages/questions.php?category_id=' . $category_id . '" target="_blank" class="btn btn-primary">Explore</a>
                </div>
              </div>');
    }



    ?>
  </div>
</div>



<?php include "partials/_includeJS.php" ?>
<script>
  $(document).ready( function(){
    $('#search').typeahead({
    source: function(query , result){
      alert(query);
      
    }
  })
  })

</script>
<?php include "partials/_footer.php" ?>