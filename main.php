<?php
$pageTitle = 'Dashboard | Fav Countries';
require_once('includes/header.php')
?>

<main class="row overflow-auto">
    <div class="col pt-4">
        <div class="d-flex justify-content-between">
            <h2 class="py-3">Countires List</h2>
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active" aria-current="page">Home</li>
            </ol>
            </nav>
        </div>
        <div class="mb-3">
            <div class="alert alert-danger none" id="mainDangerAlert"></div>
        </div>
        <div class="mb-3">
            <div class="alert alert-success none" id="mainSuccessAlert"></div>
        </div>

        <table class="table table-striped" id="countriesTable">
            <thead>
                <tr>
                    <th>Country Name</th>
                    <th>Region</th>
                    <th>Population</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <h2 class="py-3">Favourites</h2>

        <div class="mb-3">
            <div class="alert alert-danger none" id="favDangerAlert"></div>
        </div>
        <div class="mb-3">
            <div class="alert alert-success none" id="favSuccessAlert"></div>
        </div>

        <table id="favTable">
            <thead>
                <tr>
                <th>Country Name</th>
                    <th>Region</th>
                    <th>Population</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

    </div>
</main>


<!-- Modal -->
<div class="modal fade" id="addToFavModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addToFavModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addToFavModalLabel">Add To Favourties</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="atfCountry">
        <input type="hidden" id="atfRegion">
        <input type="hidden" id="atfPopulation">
        <input type="text" id="atfDescription" class="form-control" placeholder="Description">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="addToFavModelBtn">Add</button>
      </div>
    </div>
  </div>

<script>
    $(document).ready(function() {
        // load countires list
        loadCountries();

        //load fav list 
        loadFavList();
    });

</script>
<?php
require_once('includes/footer.php')
?>