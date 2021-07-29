// login script
$("#loginBtn").click(() => {
  $("#loginDangerAlert").hide("");
  $("#loginDangerAlert").html("");
  let email = $("#loginEmail").val();
  let password = $("#loginPassword").val();
  let formErrors = false;
  if (email == "") {
    formErrors = true;
    $("#loginDangerAlert").show();
    $("#loginDangerAlert").html("Email is required");
  }
  if (password == "") {
    formErrors = true;
    $("#loginDangerAlert").show();
    $("#loginDangerAlert").html("Password is required");
  }
  if (!formErrors) {
    const settings = {
      async: true,
      crossDomain: true,
      url: "api.php",
      method: "POST",
      data: {
        login: true,
        email: email,
        password: password,
      },
    };
    $.ajax(settings)
      .done(function (res) {
        response = JSON.parse(res);
        if (response.status == "success") {
          window.location.href = "main.php";
        } else {
          $("#loginDangerAlert").show();
          $("#loginDangerAlert").html(response.message);
        }
      })
      .fail(function (error) {
        // show error if there is error
        if (error.status == 401) {
          $("#loginDangerAlert").show();
          $("#loginDangerAlert").html("Email or password incorrect");
        } else {
          $("#loginDangerAlert").show();
          $("#loginDangerAlert").html("Failed to login");
        }
      });
  }
});

// signup script
$("#signupBtn").click(() => {
  $("#signupDangerAlert").hide("");
  $("#signupDangerAlert").html("");
  let name = $("#signupName").val();
  let gender = $("#signupGender").val();
  let email = $("#signupEmail").val();
  let password = $("#signupPassword").val();
  let confirmPassword = $("#signupConfirmPassword").val();
  let errorMsgs = "";
  let formErrors = false;
  if (name == "") {
    formErrors = true;
    errorMsgs += "Name is required. ";
  }
  if (gender == "") {
    formErrors = true;
    errorMsgs += "Gender is required. ";
  }
  if (email == "") {
    formErrors = true;
    errorMsgs += "Email is required. ";
  }
  if (password == "") {
    formErrors = true;
    errorMsgs += "Password is required. ";
  }
  if (confirmPassword == "") {
    formErrors = true;
    errorMsgs += "Confirm Password is required. ";
  }
  if (confirmPassword != password) {
    formErrors = true;
    errorMsgs += "Password and Confirm Password are not same. ";
  }
  if (formErrors) {
    $("#signupDangerAlert").show();
    $("#signupDangerAlert").html(errorMsgs);
  } else {
    const settings = {
      async: true,
      crossDomain: true,
      url: "api.php",
      method: "POST",
      data: {
        signup: true,
        name,
        gender,
        email,
        password,
        confirmPassword,
      },
    };
    $.ajax(settings)
      .done(function (res) {
        response = JSON.parse(res);
        if (response.status == "success") {
          window.location.href = "main.php";
        } else {
          $("#signupDangerAlert").show();
          $("#signupDangerAlert").html(response.message);
        }
      })
      .fail(function (error) {
        // show error if there is error
        if (error.status == 401) {
          $("#signupDangerAlert").show();
          $("#signupDangerAlert").html("Failed to register");
        } else {
          $("#signupDangerAlert").show();
          $("#signupDangerAlert").html("Failed to register");
        }
      });
  }
});

// check if email already regsitered
$("#signupEmail").keyup(() => {
  $("#signupDangerAlert").hide("");
  $("#signupDangerAlert").html("");
  const settings = {
    async: true,
    crossDomain: true,
    url: "api.php",
    method: "POST",
    data: {
      checkEmail: true,
      email: $("#signupEmail").val(),
    },
  };
  $.ajax(settings).done(function (response) {
    if (response == 0) {
    } else {
      $("#signupDangerAlert").show();
      $("#signupDangerAlert").html(response);
    }
  });
});

function logout(e) {
  e.preventDefault();
  const settings = {
    async: true,
    crossDomain: true,
    url: "api.php",
    method: "POST",
    data: {
      logout: true,
    },
  };
  $.ajax(settings).done(function (response) {
    if (response == 1) {
      location.reload();
    }
  });
}

function addRemoveFav(reqType, countryName, countryRegion, countryPopulation, description) {
  $("#mainSuccessAlert").hide();
  const settings = {
    async: true,
    crossDomain: true,
    url: "api.php",
    method: "POST",
    data: {
      addRemoveFav: true,
      reqType,
      countryName,
      countryRegion,
      countryPopulation,
      description
    },
  };
  $.ajax(settings)
    .done(function (res) {
      let response = JSON.parse(res);
      if (response.status == "success") {
        $("#mainSuccessAlert").show();
        $("#mainSuccessAlert").html(response.message);
        $("#favSuccessAlert").show();
        $("#favSuccessAlert").html(response.message);
        $("#addToFavModal").modal('hide');
        loadFavList();
      } else {
        $("#mainDangerAlert").show();
        $("#mainDangerAlert").html(response.message);
      }
    })
    .fail(function (error) {
      if (error.status == 401) {
        $("#mainDangerAlert").show();
        $("#mainDangerAlert").html("Unauthorized");
      }
    });
}

function loadFavList() {
  $("#favTable").dataTable().fnDestroy();

  const settingsFav = {
    async: true,
    crossDomain: true,
    url: "api.php",
    method: "GET",
    data: {
      getFavList: true,
    },
  };
  $.ajax(settingsFav)
    .done(function (res) {
      let response = JSON.parse(res);
      html = "";
      response.data.forEach((value) => {
        html += `<tr><td>${value.country_name}</td><td>${value.country_region}</td><td>${value.country_population}</td><td>${value.description ? value.description : ''}</td><td>${value.created_at}</td><td><button class="btn btn-outline-danger fav-color" onclick='addRemoveFav("remove", "${value.country_name}", "${value.country_region}", "${value.country_population}", "")'><i class="bi-trash"></i></button></td></tr>`;
      });
      $("#favTable tbody").html(html);
      $("#favTable").DataTable({
        pageLength: 5,
      });
    })
    .fail(function (error) {
      // show error if there is error
      if (error.status == 401) {
        $("#favDangerAlert").show();
        $("#favDangerAlert").html("Unauthorized");
      }
    });
}


function loadCountries() {
  const settings = {
    async: true,
    crossDomain: true,
    url: "https://restcountries.eu/rest/v2/all",
    method: "GET",
  };
  $.ajax(settings)
    .done(function (response) {
      if (response.length > 1) {
        html = "";
        response.forEach((value) => {
          html += `<tr><td>${value.name}</td><td>${value.region}</td><td>${value.population}</td><td><button class="btn btn-outline-danger" onclick='openAddToFavModal("add", "${value.name}", "${value.region}", "${value.population}")'><i class="bi-heart"></i></button></td></tr>`;
        });
        $("#countriesTable tbody").html(html);
        $("#countriesTable").DataTable({
          pageLength: 5,
          destroy: true,
        });
      } else {
        $("#mainDangerAlert").show();
        $("#mainDangerAlert").html(response.message);
      }
    })
    .fail(function (error) {
      // show error if there is error
      if (error.status == 401) {
        $("#mainDangerAlert").show();
        $("#mainDangerAlert").html("Unauthorized");
      }
    });
}

function openAddToFavModal(reqType, countryName, countryRegion, countryPopulation) {
  $("#addToFavModal").modal('show');
  $("#atfCountry").val(countryName);
  $("#atfRegion").val(countryRegion);
  $("#atfPopulation").val(countryPopulation);
  $("#atfDescription").val("");
}

$("#addToFavModelBtn").click( () => {
  let countryName = $("#atfCountry").val();
  let countryRegion = $("#atfRegion").val();
  let countryPopulation = $("#atfPopulation").val();
  let description = $("#atfDescription").val();
  let reqType = "add";
  addRemoveFav(reqType, countryName, countryRegion, countryPopulation, description);
})