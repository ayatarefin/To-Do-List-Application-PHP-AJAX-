$(document).ready(function () {
  $(document).on("submit", "#to_do_form", function (event) {
    event.preventDefault();

    if ($("#task_name").val() == "") {
      $("#message").html(
        '<div class="alert alert-danger">Enter Task Details</div>'
      );
      return false;
    } else {
      $("#submit").attr("disabled", "disabled");
      $.ajax({
        url: "add_task.php",
        method: "POST",
        data: $(this).serialize(),
        success: function (data) {
          $("#submit").attr("disabled", false);
          $("#to_do_form")[0].reset();
          $(".list-group").prepend(data);
        },
      });
    }
  });

  $(document).on("click", ".list-group-item", function () {
    var task_id = $(this).data("id");
    $.ajax({
      url: "update_task.php",
      method: "POST",
      data: { task_id: task_id },
      success: function (data) {
        $("#list-group-item-" + task_id).css("text-decoration", "line-through");
      },
    });
  });

  $(document).on("click", ".badge", function () {
    var task_id = $(this).data("id");
    $.ajax({
      url: "delete_task.php",
      method: "POST",
      data: { task_id: task_id },
      success: function (data) {
        $("#list-group-item-" + task_id).fadeOut("slow");
      },
    });
  });
});
// Display current date in the date card
$(document).ready(function () {
  var currentDate = new Date();
  var options = {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  };
  document.getElementById("current-date").innerHTML =
    currentDate.toLocaleDateString(undefined, options);
});
