//POPUP
class popup {
    constructor(ApiResponse, r) {
        this.selectorClass = "popup";
        this.appendSelector = "body";
        $("." + this.selectorClass).off("click");
        this.init();
    }
    init() {
        let popUpTog = document.querySelectorAll("." + this.selectorClass);
        var _this = this;
        popUpTog.forEach(function(el) {
            $(el).on("click", function(e) {
                e.preventDefault();
                let url = el.getAttribute("href");
                let w = el.getAttribute("data-w");
                let ccs = "";
                if (w) {
                    ccs = "width:" + w + "px";
                }
                axios
                    .get(url + "?ajx")
                    .then(function(response) {
                        // handle success
                        var uID = Date.now();
                        $(_this.appendSelector).append(
                            "<div class='popup-wrap " +
                            uID +
                            "'><div class='popup-body' style='" +
                            ccs +
                            "'><span class='closePopup'>×</span>" +
                            response.data +
                            "</div></div>"
                        );
                        let popUpForm = $("." + uID).find("form.ajx");
                        $(popUpForm).on("submit", (e) => {
                            //Form Submit by Ajax
                            e.preventDefault();
                            let submitRoute = popUpForm.attr("action");
                            postData(submitRoute, $(popUpForm).serialize(), function(res) {
                                LoadData();
                                $("." + uID).remove();
                            }); //Post Data to server
                        });
                        $(".closePopup").on("click", function() {
                            $(this).closest(".popup-wrap").remove();
                        });
                    })
                    .catch(function(error) {
                        ntf(error, "error"); //error.response.headers);
                    });
            });
        });
    }
}

//Pagination Builder
class pagination {
    constructor(ApiResponse, r) {
        this.current = ApiResponse.current_page;
        this.links = ApiResponse.links;
        this.DomRoot = r;
        this.data = ApiResponse.data;
    }

    linksHtm() {
        var htm = "";
        var _this = this;
        if (_this.data.length > 0) {
            _this.links.forEach(function(el) {
                if (el.url !== null) {
                    let act = "";
                    if (el.active) {
                        act = "active";
                    }
                    htm += `<a href="javascript:void(0)" class="${act}" onclick="LoadData('${el.url}')">${el.label}</a>`;
                }
            });
        }
        return htm;
    }
}
//Pagination Builder

export { popup, pagination };