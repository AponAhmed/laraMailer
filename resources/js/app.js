require("./bootstrap");
import axios from "axios";
import $ from "jquery";
import Notiflix from "notiflix";
import { popup, pagination } from "./elements";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import IoIcon from "./icon";

const icon = new IoIcon();
icon.init();

window.ClassicEditor = ClassicEditor;
window.popup = popup;
window.pagination = pagination;
window.Notiflix = Notiflix;
window.ntf = function (txt, cls) {
  if (cls != "error") {
    Notiflix.Notify.success(`${txt}`);
  } else {
    Notiflix.Notify.failure(`${txt}`);
  }
};

function postData(route, data, calback) {
  axios
    .post(route, data)
    .then((response) => {
      if (response.data.error) {
        ntf(response.data.msg, "error");
      } else {
        calback(response);
        ntf(response.data.msg, "success");
      }
    })
    .catch((error) => {
      ntf(error, "error"); //error.response.headers);
    });
}
window.postData = postData;
window.deleteData = function (e, _this) {
  e.preventDefault();
  Notiflix.Confirm.show(
    "Delete Conformation",
    "Are You Want To Delete?",
    "Yes",
    "No",
    function () {
      let route = $(_this).attr("href");
      axios
        .get(route)
        .then((response) => {
          if (response.data == 1) {
            LoadData();
            ntf("Data Delation Success", "success");
          } else {
            ntf("Failed to Delete", "error");
          }
        })
        .catch((error) => {
          ntf(error, "error");
        });
    }
  );
};
