const menuIconEl = $(".menu-icon");
const sidenavEl = $(".sidenav");
const sidenavCloseEl = $(".sidenav-close-icon");

function toggleClassName(el, className) {
  if (el.hasClass(className)) {
    el.removeClass(className);
  } else {
    el.addClass(className);
  }
}

menuIconEl.on("click", function () {
  toggleClassName(sidenavEl, "active");
});

sidenavCloseEl.on("click", function () {
  toggleClassName(sidenavEl, "active");
});

$(document).ready(function () {
  $("#datatable").DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json",
    },
  });
});
