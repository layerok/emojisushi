(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[5],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/UsersIndex.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/UsersIndex.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_0__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//


var getUsers = function getUsers(page, callback) {
  var params = {
    page: page
  };
  axios__WEBPACK_IMPORTED_MODULE_0___default.a.get('/api/categories', {
    params: params
  }).then(function (response) {
    callback(null, response.data);
  })["catch"](function (error) {
    callback(error, error.response.data);
  });
};

/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      users: null,
      meta: null,
      links: {
        first: null,
        last: null,
        next: null,
        prev: null
      },
      error: null
    };
  },
  computed: {
    nextPage: function nextPage() {
      if (!this.meta || this.meta.current_page === this.meta.last_page) {
        return;
      }

      return this.meta.current_page + 1;
    },
    prevPage: function prevPage() {
      if (!this.meta || this.meta.current_page === 1) {
        return;
      }

      return this.meta.current_page - 1;
    },
    paginatonCount: function paginatonCount() {
      if (!this.meta) {
        return;
      }

      var _this$meta = this.meta,
          current_page = _this$meta.current_page,
          last_page = _this$meta.last_page;
      return "".concat(current_page, " of ").concat(last_page);
    }
  },
  beforeRouteEnter: function beforeRouteEnter(to, from, next) {
    getUsers(to.query.page, function (err, data) {
      console.log(data);
      next(function (vm) {
        return vm.setData(err, data);
      });
    });
  },
  // when route changes and this component is already rendered,
  // the logic will be slightly different.
  beforeRouteUpdate: function beforeRouteUpdate(to, from, next) {
    var _this = this;

    this.users = this.links = this.meta = null;
    getUsers(to.query.page, function (err, data) {
      console.log(data);

      _this.setData(err, data);

      next();
    });
  },
  methods: {
    goToNext: function goToNext() {
      this.$router.push({
        query: {
          page: this.nextPage
        }
      });
    },
    goToPrev: function goToPrev() {
      this.$router.push({
        name: 'categories.index',
        query: {
          page: this.prevPage
        }
      });
    },
    setData: function setData(err, _ref) {
      var users = _ref.data,
          links = _ref.links,
          meta = _ref.meta;

      if (err) {
        this.error = err.toString();
      } else {
        this.users = users;
        this.links = links;
        this.meta = meta;
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/UsersIndex.vue?vue&type=template&id=3f01edee&":
/*!********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/UsersIndex.vue?vue&type=template&id=3f01edee& ***!
  \********************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "users" }, [
    _vm.error
      ? _c("div", { staticClass: "error" }, [
          _c("p", [_vm._v(_vm._s(_vm.error))])
        ])
      : _vm._e(),
    _vm._v(" "),
    _vm.users
      ? _c(
          "ul",
          _vm._l(_vm.users, function(ref) {
            var id = ref.id
            var name = ref.name
            var slug = ref.slug
            return _c("li", [
              _c("strong", [_vm._v("Name:")]),
              _vm._v(" " + _vm._s(name) + ",\n            "),
              _c("strong", [_vm._v("Email:")]),
              _vm._v(" " + _vm._s(slug) + "\n        ")
            ])
          }),
          0
        )
      : _vm._e(),
    _vm._v(" "),
    _c("div", { staticClass: "pagination" }, [
      _c(
        "button",
        {
          attrs: { disabled: !_vm.prevPage },
          on: {
            click: function($event) {
              $event.preventDefault()
              return _vm.goToPrev($event)
            }
          }
        },
        [_vm._v("Previous")]
      ),
      _vm._v("\n        " + _vm._s(_vm.paginatonCount) + "\n        "),
      _c(
        "button",
        {
          attrs: { disabled: !_vm.nextPage },
          on: {
            click: function($event) {
              $event.preventDefault()
              return _vm.goToNext($event)
            }
          }
        },
        [_vm._v("Next")]
      )
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/UsersIndex.vue":
/*!*******************************************!*\
  !*** ./resources/js/views/UsersIndex.vue ***!
  \*******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _UsersIndex_vue_vue_type_template_id_3f01edee___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./UsersIndex.vue?vue&type=template&id=3f01edee& */ "./resources/js/views/UsersIndex.vue?vue&type=template&id=3f01edee&");
/* harmony import */ var _UsersIndex_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./UsersIndex.vue?vue&type=script&lang=js& */ "./resources/js/views/UsersIndex.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _UsersIndex_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _UsersIndex_vue_vue_type_template_id_3f01edee___WEBPACK_IMPORTED_MODULE_0__["render"],
  _UsersIndex_vue_vue_type_template_id_3f01edee___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/UsersIndex.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/UsersIndex.vue?vue&type=script&lang=js&":
/*!********************************************************************!*\
  !*** ./resources/js/views/UsersIndex.vue?vue&type=script&lang=js& ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_UsersIndex_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./UsersIndex.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/UsersIndex.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_UsersIndex_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/UsersIndex.vue?vue&type=template&id=3f01edee&":
/*!**************************************************************************!*\
  !*** ./resources/js/views/UsersIndex.vue?vue&type=template&id=3f01edee& ***!
  \**************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_UsersIndex_vue_vue_type_template_id_3f01edee___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./UsersIndex.vue?vue&type=template&id=3f01edee& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/UsersIndex.vue?vue&type=template&id=3f01edee&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_UsersIndex_vue_vue_type_template_id_3f01edee___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_UsersIndex_vue_vue_type_template_id_3f01edee___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);