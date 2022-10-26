(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Product.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Product.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
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
/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'product',
  props: {
    product: {
      type: Object,
      "default": null
    },
    prod_categories: {
      type: Array,
      "default": []
    },
    types: {
      type: Array,
      "default": []
    },
    colors: {
      type: Array,
      "default": []
    },
    images: {
      type: Array,
      "default": []
    },
    social_media: {
      type: Object,
      "default": null
    },
    user: {
      type: Object,
      "default": function _default() {
        return null;
      }
    }
  },
  data: function data() {
    return {
      prodcolor: null,
      prodtypes: [],
      categories: this.prod_categories,
      quantity: 1,
      prodId: null,
      price: 0,
      totalprice: 0,
      typesTotalPrice: 0,
      productImage: null,
      haslogo: 0,
      logoprice: 0,
      logofile: null
    };
  },
  computed: {
    hasAuthUser: function hasAuthUser() {
      if (!this.user) {
        return false;
      }

      return Object.keys(this.user).length > 0;
    }
  },
  methods: {
    changeImage: function changeImage(image, index) {
      this.productImage = '/storage/products/' + image;
      var prevThumb = document.querySelector('.is-active');
      prevThumb.classList.remove('is-active');
      var thumb = document.getElementById(index);
      thumb.classList.add('is-active'); // Remove active class from thumbs
      // thumbs.each(function() {
      //     if( $(this).hasClass('is-active') ) {
      //     $(this).removeClass('is-active');
      //     }
      // });
    },
    initOrder: function initOrder() {
      if (this.product) {
        this.prodId = this.product.id;
        this.haslogo = this.product.haslogo;
        this.logoprice = this.product.logoprice;
        this.price = this.product.discount_price ? parseFloat(this.product.discount_price) : parseFloat(this.product.price);
        this.prodcolor = this.colors[0];
        this.productImage = '/storage/products/' + this.images[0].productImages;

        if (this.types.length > 0) {
          // this.typesTotalPrice = 0;
          for (var i = 0; i < this.types.length; i++) {
            this.prodtypes.push(this.types[i].variants[0]);
          }
        }
      }
    },
    UploadFile: function UploadFile(e) {
      var _this = this;

      var file = e.target.files[0];
      var formfile = new FormData();
      formfile.set('logofile', file);
      axios.post('/upload-logo', formfile).then(function (response) {
        _this.logofile = response.data;

        _this.$swal('Done', 'Your file has been successfully uploaded!', 'success');
      })["catch"](function (error) {
        _this.$swal('Error!', 'Error happening during uploading your file!', 'error');
      });
    },
    recalculatePrice: function recalculatePrice() {
      if (this.prodtypes.length > 0) {
        this.typesTotalPrice = 0;

        for (var i = 0; i < this.prodtypes.length; i++) {
          this.typesTotalPrice += this.prodtypes[i].price;
        }
      }

      this.totalprice = this.price + (this.prodcolor ? this.prodcolor.price : 0) + this.typesTotalPrice;
      return;
    },
    colorChange: function colorChange(color) {
      this.prodcolor = color;
      this.recalculatePrice();
    },
    typeChange: function typeChange(event) {
      this.recalculatePrice();
    },
    quantityChange: function quantityChange(event) {},
    increaseQty: function increaseQty() {
      this.quantity += 1;
    },
    decreaseQty: function decreaseQty() {
      if (this.quantity > 1) this.quantity -= 1;
    },
    saveBatch: function saveBatch() {
      var _this2 = this;

      var formData = new FormData();
      formData.append('id', this.prodId);
      formData.append('quantity', this.quantity);
      formData.append('prodcolor', this.prodcolor ? JSON.stringify(this.prodcolor) : null);
      formData.append('prodtypes', this.prodtypes ? JSON.stringify(this.prodtypes) : null);
      formData.append('logofile', this.logofile ? this.logofile : null);
      axios.post('/add-to-cart', formData).then(function (response) {
        setTimeout(function () {
          window.location.href = "/cart";
        }, 1000);
      })["catch"](function (error) {
        self.issummaring = 0;
        _this2.savingStatus = true;
      }); // this.$store.dispatch('CustomProductConfigurator/saveBatch')
      //     .then((response) => {
      //         this.$notify({
      //             group: 'main',
      //             type: 'success',
      //             title: 'Custom Product Configurator',
      //             text: "Custom Product succesfully saved"
      //         });
      //         setTimeout(() => {
      //             window.location = response.request.responseURL
      //         }, 1500);
      //     })
      //     .catch(err => {
      //         this.$notify({
      //             group: 'main',
      //             type: 'error',
      //             title: 'Custom Product Configurator',
      //             text: 'Error Occurred'
      //         });
      //     });
    },
    redirectToLogin: function redirectToLogin() {
      window.location.href = "/login";
    }
  },
  mounted: function mounted() {
    this.initOrder();
    this.recalculatePrice();
  },
  created: function created() {}
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ProductDisplay.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ProductDisplay.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
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
/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'product',
  props: {
    product: {
      type: Object,
      "default": null
    },
    prod_categories: {
      type: Array,
      "default": []
    },
    types: {
      type: Array,
      "default": []
    },
    colors: {
      type: Array,
      "default": []
    },
    images: {
      type: Array,
      "default": []
    },
    social_media: {
      type: Object,
      "default": null
    },
    user: {
      type: Object,
      "default": function _default() {
        return null;
      }
    }
  },
  data: function data() {
    return {
      prodcolor: null,
      prodtypes: [],
      categories: this.prod_categories,
      quantity: 1,
      prodId: null,
      price: 0,
      totalprice: 0,
      typesTotalPrice: 0,
      productImage: null,
      haslogo: 0,
      logoprice: 0,
      logofile: null
    };
  },
  computed: {
    hasAuthUser: function hasAuthUser() {
      if (!this.user) {
        return false;
      }

      return Object.keys(this.user).length > 0;
    }
  },
  methods: {
    changeImage: function changeImage(image, index) {
      this.productImage = '/storage/products/' + image;
      var prevThumb = document.querySelector('.is-active');
      prevThumb.classList.remove('is-active');
      var thumb = document.getElementById(index);
      thumb.classList.add('is-active'); // Remove active class from thumbs
      // thumbs.each(function() {
      //     if( $(this).hasClass('is-active') ) {
      //     $(this).removeClass('is-active');
      //     }
      // });
    },
    initOrder: function initOrder() {
      if (this.product) {
        this.prodId = this.product.id;
        this.haslogo = this.product.haslogo;
        this.logoprice = this.product.logoprice;
        this.price = this.product.discount_price ? parseFloat(this.product.discount_price) : parseFloat(this.product.price);
        this.prodcolor = this.colors[0];
        this.productImage = '/storage/products/' + this.images[0].productImages;

        if (this.types.length > 0) {
          // this.typesTotalPrice = 0;
          for (var i = 0; i < this.types.length; i++) {
            this.prodtypes.push(this.types[i].variants[0]);
          }
        }
      }
    },
    UploadFile: function UploadFile(e) {
      var _this = this;

      var file = e.target.files[0];
      var formfile = new FormData();
      formfile.set('logofile', file);
      axios.post('/upload-logo', formfile).then(function (response) {
        _this.logofile = response.data;

        _this.$swal('Done', 'Your file has been successfully uploaded!', 'success');
      })["catch"](function (error) {
        _this.$swal('Error!', 'Error happening during uploading your file!', 'error');
      });
    },
    recalculatePrice: function recalculatePrice() {
      if (this.prodtypes.length > 0) {
        this.typesTotalPrice = 0;

        for (var i = 0; i < this.prodtypes.length; i++) {
          this.typesTotalPrice += this.prodtypes[i].price;
        }
      }

      this.totalprice = this.price + (this.prodcolor ? this.prodcolor.price : 0) + this.typesTotalPrice;
      return;
    },
    colorChange: function colorChange(color) {
      this.prodcolor = color;
      this.recalculatePrice();
    },
    typeChange: function typeChange(event) {
      this.recalculatePrice();
    },
    quantityChange: function quantityChange(event) {},
    increaseQty: function increaseQty() {
      this.quantity += 1;
    },
    decreaseQty: function decreaseQty() {
      if (this.quantity > 1) this.quantity -= 1;
    },
    saveBatch: function saveBatch() {
      var _this2 = this;

      var formData = new FormData();
      formData.append('id', this.prodId);
      formData.append('quantity', this.quantity);
      formData.append('prodcolor', this.prodcolor ? JSON.stringify(this.prodcolor) : null);
      formData.append('prodtypes', this.prodtypes ? JSON.stringify(this.prodtypes) : null);
      formData.append('logofile', this.logofile ? this.logofile : null);
      axios.post('/add-to-cart', formData).then(function (response) {
        setTimeout(function () {
          window.location.href = "/cart";
        }, 1000);
      })["catch"](function (error) {
        self.issummaring = 0;
        _this2.savingStatus = true;
      }); // this.$store.dispatch('CustomProductConfigurator/saveBatch')
      //     .then((response) => {
      //         this.$notify({
      //             group: 'main',
      //             type: 'success',
      //             title: 'Custom Product Configurator',
      //             text: "Custom Product succesfully saved"
      //         });
      //         setTimeout(() => {
      //             window.location = response.request.responseURL
      //         }, 1500);
      //     })
      //     .catch(err => {
      //         this.$notify({
      //             group: 'main',
      //             type: 'error',
      //             title: 'Custom Product Configurator',
      //             text: 'Error Occurred'
      //         });
      //     });
    },
    redirectToLogin: function redirectToLogin() {
      window.location.href = "/login";
    }
  },
  mounted: function mounted() {
    this.initOrder();
    this.recalculatePrice();
  },
  created: function created() {}
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Product.vue?vue&type=style&index=0&id=7e94e6d4&scoped=true&lang=css&":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Product.vue?vue&type=style&index=0&id=7e94e6d4&scoped=true&lang=css& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n/* img {\n  max-width: 100%;\n} */\n\n\n/**\n * Helper Styles\n */\n.ir[data-v-7e94e6d4] {\n  text-indent: 100%;\n  white-space: nowrap;\n  overflow: hidden;\n}\n    /**\n * Gallery Styles\n * 1. Enable fluid images\n */\n.gallery[data-v-7e94e6d4] {\n  overflow: hidden;\n}\n.gallery__hero[data-v-7e94e6d4] {\n  overflow: hidden;\n  position: relative;\n  padding: 2em;\n  margin: 0 0 0.3333333333em;\n  background: #fff;\n}\n.is-zoomed .gallery__hero[data-v-7e94e6d4] {\n  cursor: move;\n}\n.is-zoomed .gallery__hero img[data-v-7e94e6d4] {\n  max-width: none;\n  position: absolute;\n  z-index: 0;\n  top: -50%;\n  left: -50%;\n}\n.gallery__hero-enlarge[data-v-7e94e6d4] {\n  position: absolute;\n  right: 0.5em;\n  bottom: 0.5em;\n  z-index: 1;\n  width: 30px;\n  height: 30px;\n  opacity: 0.5;\n  background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzMCIgaGVpZ2h0PSIzMCIgdmlld0JveD0iNS4wIC0xMC4wIDEwMC4wIDEzNS4wIiBmaWxsPSIjMzRCZjQ5Ij48cGF0aCBkPSJNOTMuNTkzIDg2LjgxNkw3Ny4wNDUgNzAuMjY4YzUuNDEzLTYuODczIDguNjQyLTE1LjUyNiA4LjY0Mi0yNC45MTRDODUuNjg3IDIzLjEwNCA2Ny41OTMgNSA0NS4zNDMgNVM1IDIzLjEwNCA1IDQ1LjM1NGMwIDIyLjI0IDE4LjA5NCA0MC4zNDMgNDAuMzQzIDQwLjM0MyA5LjQgMCAxOC4wNjItMy4yNCAyNC45MjQtOC42NTNsMTYuNTUgMTYuNTZjLjkzNy45MjcgMi4xNjIgMS4zOTYgMy4zODggMS4zOTYgMS4yMjUgMCAyLjQ1LS40NyAzLjM5LTEuMzk2IDEuODc0LTEuODc1IDEuODc0LTQuOTEyLS4wMDItNi43ODh6bS00OC4yNS0xMC43MWMtMTYuOTU0IDAtMzAuNzUzLTEzLjc5OC0zMC43NTMtMzAuNzUyIDAtMTYuOTY0IDEzLjgtMzAuNzY0IDMwLjc1My0zMC43NjQgMTYuOTY0IDAgMzAuNzUzIDEzLjggMzAuNzUzIDMwLjc2NCAwIDE2Ljk1NC0xMy43ODggMzAuNzUzLTMwLjc1MyAzMC43NTN6TTYzLjAzMiA0NS4zNTRjMCAyLjM0NC0xLjkwNyA0LjI2Mi00LjI2MiA0LjI2MmgtOS4xNjR2OS4xNjRjMCAyLjM0NC0xLjkwNyA0LjI2Mi00LjI2MiA0LjI2Mi0yLjM1NSAwLTQuMjYyLTEuOTE4LTQuMjYyLTQuMjYydi05LjE2NGgtOS4xNjRjLTIuMzU1IDAtNC4yNjItMS45MTgtNC4yNjItNC4yNjIgMC0yLjM1NSAxLjkwNy00LjI2MiA0LjI2Mi00LjI2Mmg5LjE2NHYtOS4xNzVjMC0yLjM0NCAxLjkwNy00LjI2MiA0LjI2Mi00LjI2MiAyLjM1NSAwIDQuMjYyIDEuOTE4IDQuMjYyIDQuMjYydjkuMTc1aDkuMTY0YzIuMzU1IDAgNC4yNjIgMS45MDcgNC4yNjIgNC4yNjJ6Ii8+PC9zdmc+);\n  background-repeat: no-repeat;\n  transition: opacity 0.3s cubic-bezier(0.455, 0.03, 0.515, 0.955);\n}\n.gallery__hero-enlarge[data-v-7e94e6d4]:hover {\n  opacity: 1;\n}\n.is-zoomed .gallery__hero-enlarge[data-v-7e94e6d4] {\n  background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzMCIgaGVpZ2h0PSIzMCIgdmlld0JveD0iNS4wIC0xMC4wIDEwMC4wIDEzNS4wIiBmaWxsPSIjMzRCZjQ5Ij48cGF0aCBkPSJNOTMuNTkzIDg2LjgxNkw3Ny4wNDUgNzAuMjY4YzUuNDEzLTYuODczIDguNjQyLTE1LjUyNiA4LjY0Mi0yNC45MTRDODUuNjg3IDIzLjEwNCA2Ny41OTMgNSA0NS4zNDMgNVM1IDIzLjEwNCA1IDQ1LjM1NGMwIDIyLjI0IDE4LjA5NCA0MC4zNDMgNDAuMzQzIDQwLjM0MyA5LjQgMCAxOC4wNjItMy4yNCAyNC45MjQtOC42NTNsMTYuNTUgMTYuNTZjLjkzNy45MjcgMi4xNjIgMS4zOTYgMy4zODggMS4zOTYgMS4yMjUgMCAyLjQ1LS40NyAzLjM5LTEuMzk2IDEuODc0LTEuODc1IDEuODc0LTQuOTEyLS4wMDItNi43ODh6TTE0LjU5IDQ1LjM1NGMwLTE2Ljk2NCAxMy44LTMwLjc2NCAzMC43NTMtMzAuNzY0IDE2Ljk2NCAwIDMwLjc1MyAxMy44IDMwLjc1MyAzMC43NjQgMCAxNi45NTQtMTMuNzkgMzAuNzUzLTMwLjc1MyAzMC43NTMtMTYuOTUzIDAtMzAuNzUzLTEzLjgtMzAuNzUzLTMwLjc1M3pNNTguNzcyIDQ5LjYxSDMxLjkyYy0yLjM1NSAwLTQuMjYzLTEuOTA3LTQuMjYzLTQuMjZzMS45MDgtNC4yNjMgNC4yNjItNC4yNjNINTguNzdjMi4zNTQgMCA0LjI2MiAxLjkwOCA0LjI2MiA0LjI2MnMtMS45MSA0LjI2LTQuMjYyIDQuMjZ6Ii8+PC9zdmc+);\n}\n.gallery__thumbs[data-v-7e94e6d4] {\n  text-align: center;\n  background: #333;\n}\n.gallery__thumbs a[data-v-7e94e6d4] {\n  display: inline-block;\n  width: 20%;\n  padding: 0.5em;\n  opacity: 0.75;\n  transition: opacity 0.3s cubic-bezier(0.455, 0.03, 0.515, 0.955);\n}\n.gallery__thumbs a[data-v-7e94e6d4]:hover {\n  opacity: 1;\n}\n.gallery__thumbs a.is-active[data-v-7e94e6d4] {\n  opacity: 0.2;\n}\ninput[type=\"file\"][data-v-7e94e6d4] {\n    display: none;\n}\n.custom-file-upload[data-v-7e94e6d4] {\n    border: 1px solid #ccc;\n    display: inline-block;\n    padding: 6px 12px;\n    cursor: pointer;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ProductDisplay.vue?vue&type=style&index=0&id=91a5db04&scoped=true&lang=css&":
/*!********************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ProductDisplay.vue?vue&type=style&index=0&id=91a5db04&scoped=true&lang=css& ***!
  \********************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n/* img {\n  max-width: 100%;\n} */\n\n\n/**\n * Helper Styles\n */\n.ir[data-v-91a5db04] {\n  text-indent: 100%;\n  white-space: nowrap;\n  overflow: hidden;\n}\n    /**\n * Gallery Styles\n * 1. Enable fluid images\n */\n.gallery[data-v-91a5db04] {\n  overflow: hidden;\n}\n.gallery__hero[data-v-91a5db04] {\n  overflow: hidden;\n  position: relative;\n  padding: 2em;\n  margin: 0 0 0.3333333333em;\n  background: #fff;\n}\n.is-zoomed .gallery__hero[data-v-91a5db04] {\n  cursor: move;\n}\n.is-zoomed .gallery__hero img[data-v-91a5db04] {\n  max-width: none;\n  position: absolute;\n  z-index: 0;\n  top: -50%;\n  left: -50%;\n}\n.gallery__hero-enlarge[data-v-91a5db04] {\n  position: absolute;\n  right: 0.5em;\n  bottom: 0.5em;\n  z-index: 1;\n  width: 30px;\n  height: 30px;\n  opacity: 0.5;\n  background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzMCIgaGVpZ2h0PSIzMCIgdmlld0JveD0iNS4wIC0xMC4wIDEwMC4wIDEzNS4wIiBmaWxsPSIjMzRCZjQ5Ij48cGF0aCBkPSJNOTMuNTkzIDg2LjgxNkw3Ny4wNDUgNzAuMjY4YzUuNDEzLTYuODczIDguNjQyLTE1LjUyNiA4LjY0Mi0yNC45MTRDODUuNjg3IDIzLjEwNCA2Ny41OTMgNSA0NS4zNDMgNVM1IDIzLjEwNCA1IDQ1LjM1NGMwIDIyLjI0IDE4LjA5NCA0MC4zNDMgNDAuMzQzIDQwLjM0MyA5LjQgMCAxOC4wNjItMy4yNCAyNC45MjQtOC42NTNsMTYuNTUgMTYuNTZjLjkzNy45MjcgMi4xNjIgMS4zOTYgMy4zODggMS4zOTYgMS4yMjUgMCAyLjQ1LS40NyAzLjM5LTEuMzk2IDEuODc0LTEuODc1IDEuODc0LTQuOTEyLS4wMDItNi43ODh6bS00OC4yNS0xMC43MWMtMTYuOTU0IDAtMzAuNzUzLTEzLjc5OC0zMC43NTMtMzAuNzUyIDAtMTYuOTY0IDEzLjgtMzAuNzY0IDMwLjc1My0zMC43NjQgMTYuOTY0IDAgMzAuNzUzIDEzLjggMzAuNzUzIDMwLjc2NCAwIDE2Ljk1NC0xMy43ODggMzAuNzUzLTMwLjc1MyAzMC43NTN6TTYzLjAzMiA0NS4zNTRjMCAyLjM0NC0xLjkwNyA0LjI2Mi00LjI2MiA0LjI2MmgtOS4xNjR2OS4xNjRjMCAyLjM0NC0xLjkwNyA0LjI2Mi00LjI2MiA0LjI2Mi0yLjM1NSAwLTQuMjYyLTEuOTE4LTQuMjYyLTQuMjYydi05LjE2NGgtOS4xNjRjLTIuMzU1IDAtNC4yNjItMS45MTgtNC4yNjItNC4yNjIgMC0yLjM1NSAxLjkwNy00LjI2MiA0LjI2Mi00LjI2Mmg5LjE2NHYtOS4xNzVjMC0yLjM0NCAxLjkwNy00LjI2MiA0LjI2Mi00LjI2MiAyLjM1NSAwIDQuMjYyIDEuOTE4IDQuMjYyIDQuMjYydjkuMTc1aDkuMTY0YzIuMzU1IDAgNC4yNjIgMS45MDcgNC4yNjIgNC4yNjJ6Ii8+PC9zdmc+);\n  background-repeat: no-repeat;\n  transition: opacity 0.3s cubic-bezier(0.455, 0.03, 0.515, 0.955);\n}\n.gallery__hero-enlarge[data-v-91a5db04]:hover {\n  opacity: 1;\n}\n.is-zoomed .gallery__hero-enlarge[data-v-91a5db04] {\n  background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzMCIgaGVpZ2h0PSIzMCIgdmlld0JveD0iNS4wIC0xMC4wIDEwMC4wIDEzNS4wIiBmaWxsPSIjMzRCZjQ5Ij48cGF0aCBkPSJNOTMuNTkzIDg2LjgxNkw3Ny4wNDUgNzAuMjY4YzUuNDEzLTYuODczIDguNjQyLTE1LjUyNiA4LjY0Mi0yNC45MTRDODUuNjg3IDIzLjEwNCA2Ny41OTMgNSA0NS4zNDMgNVM1IDIzLjEwNCA1IDQ1LjM1NGMwIDIyLjI0IDE4LjA5NCA0MC4zNDMgNDAuMzQzIDQwLjM0MyA5LjQgMCAxOC4wNjItMy4yNCAyNC45MjQtOC42NTNsMTYuNTUgMTYuNTZjLjkzNy45MjcgMi4xNjIgMS4zOTYgMy4zODggMS4zOTYgMS4yMjUgMCAyLjQ1LS40NyAzLjM5LTEuMzk2IDEuODc0LTEuODc1IDEuODc0LTQuOTEyLS4wMDItNi43ODh6TTE0LjU5IDQ1LjM1NGMwLTE2Ljk2NCAxMy44LTMwLjc2NCAzMC43NTMtMzAuNzY0IDE2Ljk2NCAwIDMwLjc1MyAxMy44IDMwLjc1MyAzMC43NjQgMCAxNi45NTQtMTMuNzkgMzAuNzUzLTMwLjc1MyAzMC43NTMtMTYuOTUzIDAtMzAuNzUzLTEzLjgtMzAuNzUzLTMwLjc1M3pNNTguNzcyIDQ5LjYxSDMxLjkyYy0yLjM1NSAwLTQuMjYzLTEuOTA3LTQuMjYzLTQuMjZzMS45MDgtNC4yNjMgNC4yNjItNC4yNjNINTguNzdjMi4zNTQgMCA0LjI2MiAxLjkwOCA0LjI2MiA0LjI2MnMtMS45MSA0LjI2LTQuMjYyIDQuMjZ6Ii8+PC9zdmc+);\n}\n.gallery__thumbs[data-v-91a5db04] {\n  text-align: center;\n  background: #333;\n}\n.gallery__thumbs a[data-v-91a5db04] {\n  display: inline-block;\n  width: 20%;\n  padding: 0.5em;\n  opacity: 0.75;\n  transition: opacity 0.3s cubic-bezier(0.455, 0.03, 0.515, 0.955);\n}\n.gallery__thumbs a[data-v-91a5db04]:hover {\n  opacity: 1;\n}\n.gallery__thumbs a.is-active[data-v-91a5db04] {\n  opacity: 0.2;\n}\ninput[type=\"file\"][data-v-91a5db04] {\n    display: none;\n}\n.custom-file-upload[data-v-91a5db04] {\n    border: 1px solid #ccc;\n    display: inline-block;\n    padding: 6px 12px;\n    cursor: pointer;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Product.vue?vue&type=style&index=0&id=7e94e6d4&scoped=true&lang=css&":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Product.vue?vue&type=style&index=0&id=7e94e6d4&scoped=true&lang=css& ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vue-loader/lib??vue-loader-options!./Product.vue?vue&type=style&index=0&id=7e94e6d4&scoped=true&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Product.vue?vue&type=style&index=0&id=7e94e6d4&scoped=true&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ProductDisplay.vue?vue&type=style&index=0&id=91a5db04&scoped=true&lang=css&":
/*!************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ProductDisplay.vue?vue&type=style&index=0&id=91a5db04&scoped=true&lang=css& ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vue-loader/lib??vue-loader-options!./ProductDisplay.vue?vue&type=style&index=0&id=91a5db04&scoped=true&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ProductDisplay.vue?vue&type=style&index=0&id=91a5db04&scoped=true&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Product.vue?vue&type=template&id=7e94e6d4&scoped=true&":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Product.vue?vue&type=template&id=7e94e6d4&scoped=true& ***!
  \**********************************************************************************************************************************************************************************************************************/
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
  return _c("section", { staticClass: "section-single-product product" }, [
    _c("div", { staticClass: "container" }, [
      _c("div", { staticClass: "row" }, [
        _c("div", { staticClass: "col-lg-5" }),
        _vm._v(" "),
        _c(
          "div",
          { staticClass: "product-summary summary col-lg-7" },
          [
            _c("h1", { staticClass: "h2 product-title" }, [
              _vm._v(_vm._s(_vm.product.name))
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "price" }, [
              _c("ins", [
                _vm._v("Unit Price: \n                            "),
                _vm.hasAuthUser
                  ? _c("span", { staticClass: "amount" }, [
                      _vm._v(_vm._s(_vm.totalprice))
                    ])
                  : _c("span", { staticClass: "amount" }, [
                      _c("a", { attrs: { href: "/login" } }, [
                        _vm._v("Login to see price")
                      ])
                    ])
              ]),
              _vm._v(" "),
              _c("br"),
              _vm._v(" "),
              _c("ins", [
                _vm._v("Total\n                             "),
                _vm.hasAuthUser
                  ? _c("span", { staticClass: "amount" }, [
                      _vm._v(_vm._s(_vm.totalprice * _vm.quantity))
                    ])
                  : _c("span", { staticClass: "amount" }, [
                      _c("a", { attrs: { href: "/login" } }, [
                        _vm._v("Login to see price")
                      ])
                    ])
              ])
            ]),
            _vm._v(" "),
            _c(
              "form",
              { staticClass: "cart-form", attrs: { action: "/" } },
              [
                _c(
                  "div",
                  { staticClass: "cart-form__item quantity quantity" },
                  [
                    _c("label", { attrs: { for: "quantity" } }, [
                      _vm._v("Qty:")
                    ]),
                    _vm._v(" "),
                    _c("input", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model.number",
                          value: _vm.quantity,
                          expression: "quantity",
                          modifiers: { number: true }
                        }
                      ],
                      staticClass: "input-text qty-1",
                      attrs: {
                        type: "text",
                        title: "Qty",
                        maxlength: "12",
                        id: "qty",
                        name: "qty"
                      },
                      domProps: { value: _vm.quantity },
                      on: {
                        change: function($event) {
                          $event.preventDefault()
                          return _vm.quantityChange.apply(null, arguments)
                        },
                        keydown: function($event) {
                          if (
                            !$event.type.indexOf("key") &&
                            _vm._k(
                              $event.keyCode,
                              "enter",
                              13,
                              $event.key,
                              "Enter"
                            )
                          ) {
                            return null
                          }
                          $event.preventDefault()
                          return _vm.quantityChange.apply(null, arguments)
                        },
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.quantity = _vm._n($event.target.value)
                        },
                        blur: function($event) {
                          return _vm.$forceUpdate()
                        }
                      }
                    })
                  ]
                ),
                _vm._v(" "),
                _vm.colors.length > 0
                  ? [
                      _c("div", { staticClass: "color-variants" }, [
                        _c("div", [
                          _vm._v("Color: "),
                          _c("span", { attrs: { id: "active-color" } }, [
                            _vm._v(
                              _vm._s(
                                _vm.prodcolor ? _vm.prodcolor.color_name : ""
                              )
                            )
                          ])
                        ]),
                        _vm._v(" "),
                        _c(
                          "ul",
                          { staticClass: "colors-list" },
                          _vm._l(_vm.colors, function(color, index) {
                            return _c(
                              "li",
                              {
                                key: "color" + index,
                                staticClass: "colors-list__item",
                                class: _vm.prodcolor
                                  ? _vm.prodcolor.color_code == color.color_code
                                    ? "colors-list__item_active"
                                    : ""
                                  : ""
                              },
                              [
                                _c(
                                  "a",
                                  {
                                    staticStyle: { cursor: "pointer" },
                                    on: {
                                      click: function($event) {
                                        return _vm.colorChange(color)
                                      }
                                    }
                                  },
                                  [
                                    _c("span", {
                                      staticClass: "prod-color",
                                      style:
                                        "background-color: " + color.color_code
                                    })
                                  ]
                                )
                              ]
                            )
                          }),
                          0
                        )
                      ])
                    ]
                  : _vm._e(),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "row" },
                  [
                    _vm._l(_vm.types, function(type, index) {
                      return [
                        _c(
                          "div",
                          { key: index, staticClass: "form-group mb-10 col-6" },
                          [
                            _c(
                              "label",
                              {
                                key: "typenane" + index,
                                attrs: { for: "type" }
                              },
                              [_vm._v(_vm._s(type.name))]
                            ),
                            _vm._v(" "),
                            _c(
                              "select",
                              {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.prodtypes[index],
                                    expression: "prodtypes[index]"
                                  }
                                ],
                                key: "type" + index,
                                staticClass: "form-control js-select2 active",
                                attrs: { name: "type" },
                                on: {
                                  change: [
                                    function($event) {
                                      var $$selectedVal = Array.prototype.filter
                                        .call($event.target.options, function(
                                          o
                                        ) {
                                          return o.selected
                                        })
                                        .map(function(o) {
                                          var val =
                                            "_value" in o ? o._value : o.value
                                          return val
                                        })
                                      _vm.$set(
                                        _vm.prodtypes,
                                        index,
                                        $event.target.multiple
                                          ? $$selectedVal
                                          : $$selectedVal[0]
                                      )
                                    },
                                    _vm.typeChange
                                  ]
                                }
                              },
                              _vm._l(type.variants, function(variant, index) {
                                return _c(
                                  "option",
                                  {
                                    key: "variant" + index,
                                    domProps: { value: variant }
                                  },
                                  [
                                    _vm._v(
                                      "\n                                        " +
                                        _vm._s(variant.name) +
                                        "\n                                    "
                                    )
                                  ]
                                )
                              }),
                              0
                            )
                          ]
                        )
                      ]
                    })
                  ],
                  2
                ),
                _vm._v(" "),
                _vm.haslogo == 1
                  ? [
                      _c(
                        "label",
                        {
                          staticClass: "col-form-label ",
                          attrs: { for: "img" }
                        },
                        [_vm._v("Upload custom logo!")]
                      ),
                      _vm._v(" "),
                      _c("br"),
                      _vm._v(" "),
                      _vm._m(0),
                      _vm._v(" "),
                      _c("input", {
                        attrs: { id: "file-upload", type: "file" },
                        on: { change: _vm.UploadFile }
                      })
                    ]
                  : _vm._e()
              ],
              2
            ),
            _vm._v(" "),
            _vm.hasAuthUser
              ? _c(
                  "button",
                  {
                    staticClass: "btn btn-primary btn-lg add_to_cart_button",
                    attrs: { title: "Add to Cart", type: "button" },
                    on: { click: _vm.saveBatch }
                  },
                  [_vm._m(1), _vm._v(" "), _c("span", [_vm._v("Add Cart")])]
                )
              : _c(
                  "button",
                  {
                    staticClass: "btn btn-primary btn-lg add_to_cart_button",
                    on: { click: _vm.redirectToLogin }
                  },
                  [_vm._m(2), _vm._v(" "), _c("span", [_vm._v("Add Cart")])]
                ),
            _vm._v(" "),
            _vm._m(3),
            _vm._v(" "),
            _vm.social_media &&
            (_vm.social_media.youtube ||
              _vm.social_media.fb ||
              _vm.social_media.ig ||
              _vm.social_media.twitter)
              ? [
                  _c("div", { staticClass: "product-summary__share" }, [
                    _c("div", [_vm._v("Share:")]),
                    _vm._v(" "),
                    _c("ul", { staticClass: "social-links" }, [
                      _vm.social_media && _vm.social_media.youtube
                        ? _c("li", [
                            _c(
                              "a",
                              {
                                attrs: {
                                  href: _vm.social_media.youtube
                                    ? _vm.social_media.youtube
                                    : ""
                                }
                              },
                              [_c("i", { staticClass: "mdi mdi-youtube-play" })]
                            )
                          ])
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.social_media && _vm.social_media.fb
                        ? _c("li", [
                            _c(
                              "a",
                              {
                                attrs: {
                                  href: _vm.social_media.fb
                                    ? _vm.social_media.fb
                                    : ""
                                }
                              },
                              [_c("i", { staticClass: "mdi mdi-facebook" })]
                            )
                          ])
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.social_media && _vm.social_media.ig
                        ? _c("li", [
                            _c("a", { attrs: { href: _vm.social_media.ig } }, [
                              _c("i", { staticClass: "mdi mdi-instagram" })
                            ])
                          ])
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.social_media && _vm.social_media.twitter
                        ? _c("li", [
                            _c(
                              "a",
                              { attrs: { href: _vm.social_media.twitter } },
                              [_c("i", { staticClass: "mdi mdi-twitter" })]
                            )
                          ])
                        : _vm._e()
                    ])
                  ])
                ]
              : _vm._e()
          ],
          2
        ),
        _vm._v(" "),
        _c("div", { staticClass: "description-block" }, [
          _c("h3", { staticClass: "mb-30" }, [_vm._v("Description")]),
          _vm._v(" "),
          _c("div", {
            staticClass: "product-description",
            domProps: { innerHTML: _vm._s(_vm.product.description) }
          })
        ])
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "label",
      { staticClass: "custom-file-upload", attrs: { for: "file-upload" } },
      [
        _c("i", { staticClass: "flaticon flaticon-cloud-upload" }),
        _vm._v(" Upload file!\n                            ")
      ]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("em", { staticClass: "fa-icon" }, [
      _c("i", { staticClass: "fa fa-shopping-cart" })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("em", { staticClass: "fa-icon" }, [
      _c("i", { staticClass: "fa fa-shopping-cart" })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "product-summary__featured" }, [
      _c("div", { staticClass: "row" }, [
        _c("div", { staticClass: "product-featured-item" }, [
          _c("div", { staticClass: "icon-box icon-box-left icon-box-circle" }, [
            _c("div", { staticClass: "icon-box__icon" }, [
              _c("i", { staticClass: "flaticon flaticon-delivery-truck" })
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "icon-box__title" }, [
              _vm._v("Free shipping")
            ])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "product-featured-item" }, [
          _c("div", { staticClass: "icon-box icon-box-left icon-box-circle" }, [
            _c("div", { staticClass: "icon-box__icon" }, [
              _c("i", { staticClass: "flaticon flaticon-blocked-padlock" })
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "icon-box__title" }, [
              _vm._v("100% secure")
            ])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "product-featured-item" }, [
          _c("div", { staticClass: "icon-box icon-box-left icon-box-circle" }, [
            _c("div", { staticClass: "icon-box__icon" }, [
              _c("i", { staticClass: "flaticon flaticon-refresh-page-arrow" })
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "icon-box__title" }, [
              _vm._v("30 day refund")
            ])
          ])
        ])
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ProductDisplay.vue?vue&type=template&id=91a5db04&scoped=true&":
/*!*****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ProductDisplay.vue?vue&type=template&id=91a5db04&scoped=true& ***!
  \*****************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "product-thumb" }, [
    _c("div", { staticClass: "product-gallery" }, [
      _c(
        "div",
        {
          staticClass: "product-gallery__big",
          attrs: { id: "js-product-big" }
        },
        [_c("img", { attrs: { src: _vm.productImage } })]
      ),
      _vm._v(" "),
      _c(
        "div",
        {
          staticClass: "product-gallery-thumbs",
          attrs: { id: "js-product-nav" }
        },
        _vm._l(_vm.images, function(image, index) {
          return _c(
            "div",
            {
              key: "image-" + index,
              staticClass: "product-gallery-thumbs__item",
              class: index == 0 ? "active" : "",
              on: {
                click: function($event) {
                  $event.preventDefault()
                  return _vm.changeImage(image.productImages, index)
                }
              }
            },
            [
              _c("img", {
                attrs: {
                  src: "/storage/products/thumbnail/" + image.productImages
                }
              })
            ]
          )
        }),
        0
      )
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return normalizeComponent; });
/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

function normalizeComponent (
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier, /* server only */
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (render) {
    options.render = render
    options.staticRenderFns = staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = 'data-v-' + scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = shadowMode
      ? function () {
        injectStyles.call(
          this,
          (options.functional ? this.parent : this).$root.$options.shadowRoot
        )
      }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functional component in vue file
      var originalRender = options.render
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return originalRender(h, context)
      }
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    }
  }

  return {
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ "./resources/js/components/Product.vue":
/*!*********************************************!*\
  !*** ./resources/js/components/Product.vue ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Product_vue_vue_type_template_id_7e94e6d4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Product.vue?vue&type=template&id=7e94e6d4&scoped=true& */ "./resources/js/components/Product.vue?vue&type=template&id=7e94e6d4&scoped=true&");
/* harmony import */ var _Product_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Product.vue?vue&type=script&lang=js& */ "./resources/js/components/Product.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _Product_vue_vue_type_style_index_0_id_7e94e6d4_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Product.vue?vue&type=style&index=0&id=7e94e6d4&scoped=true&lang=css& */ "./resources/js/components/Product.vue?vue&type=style&index=0&id=7e94e6d4&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Product_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Product_vue_vue_type_template_id_7e94e6d4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Product_vue_vue_type_template_id_7e94e6d4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "7e94e6d4",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Product.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Product.vue?vue&type=script&lang=js&":
/*!**********************************************************************!*\
  !*** ./resources/js/components/Product.vue?vue&type=script&lang=js& ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Product_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Product.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Product.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Product_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Product.vue?vue&type=style&index=0&id=7e94e6d4&scoped=true&lang=css&":
/*!******************************************************************************************************!*\
  !*** ./resources/js/components/Product.vue?vue&type=style&index=0&id=7e94e6d4&scoped=true&lang=css& ***!
  \******************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Product_vue_vue_type_style_index_0_id_7e94e6d4_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/style-loader!../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vue-loader/lib??vue-loader-options!./Product.vue?vue&type=style&index=0&id=7e94e6d4&scoped=true&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Product.vue?vue&type=style&index=0&id=7e94e6d4&scoped=true&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Product_vue_vue_type_style_index_0_id_7e94e6d4_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Product_vue_vue_type_style_index_0_id_7e94e6d4_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Product_vue_vue_type_style_index_0_id_7e94e6d4_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Product_vue_vue_type_style_index_0_id_7e94e6d4_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));


/***/ }),

/***/ "./resources/js/components/Product.vue?vue&type=template&id=7e94e6d4&scoped=true&":
/*!****************************************************************************************!*\
  !*** ./resources/js/components/Product.vue?vue&type=template&id=7e94e6d4&scoped=true& ***!
  \****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Product_vue_vue_type_template_id_7e94e6d4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Product.vue?vue&type=template&id=7e94e6d4&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Product.vue?vue&type=template&id=7e94e6d4&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Product_vue_vue_type_template_id_7e94e6d4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Product_vue_vue_type_template_id_7e94e6d4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/ProductDisplay.vue":
/*!****************************************************!*\
  !*** ./resources/js/components/ProductDisplay.vue ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ProductDisplay_vue_vue_type_template_id_91a5db04_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ProductDisplay.vue?vue&type=template&id=91a5db04&scoped=true& */ "./resources/js/components/ProductDisplay.vue?vue&type=template&id=91a5db04&scoped=true&");
/* harmony import */ var _ProductDisplay_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ProductDisplay.vue?vue&type=script&lang=js& */ "./resources/js/components/ProductDisplay.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _ProductDisplay_vue_vue_type_style_index_0_id_91a5db04_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./ProductDisplay.vue?vue&type=style&index=0&id=91a5db04&scoped=true&lang=css& */ "./resources/js/components/ProductDisplay.vue?vue&type=style&index=0&id=91a5db04&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _ProductDisplay_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ProductDisplay_vue_vue_type_template_id_91a5db04_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ProductDisplay_vue_vue_type_template_id_91a5db04_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "91a5db04",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/ProductDisplay.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/ProductDisplay.vue?vue&type=script&lang=js&":
/*!*****************************************************************************!*\
  !*** ./resources/js/components/ProductDisplay.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductDisplay_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./ProductDisplay.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ProductDisplay.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductDisplay_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/ProductDisplay.vue?vue&type=style&index=0&id=91a5db04&scoped=true&lang=css&":
/*!*************************************************************************************************************!*\
  !*** ./resources/js/components/ProductDisplay.vue?vue&type=style&index=0&id=91a5db04&scoped=true&lang=css& ***!
  \*************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductDisplay_vue_vue_type_style_index_0_id_91a5db04_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/style-loader!../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vue-loader/lib??vue-loader-options!./ProductDisplay.vue?vue&type=style&index=0&id=91a5db04&scoped=true&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ProductDisplay.vue?vue&type=style&index=0&id=91a5db04&scoped=true&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductDisplay_vue_vue_type_style_index_0_id_91a5db04_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductDisplay_vue_vue_type_style_index_0_id_91a5db04_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductDisplay_vue_vue_type_style_index_0_id_91a5db04_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductDisplay_vue_vue_type_style_index_0_id_91a5db04_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));


/***/ }),

/***/ "./resources/js/components/ProductDisplay.vue?vue&type=template&id=91a5db04&scoped=true&":
/*!***********************************************************************************************!*\
  !*** ./resources/js/components/ProductDisplay.vue?vue&type=template&id=91a5db04&scoped=true& ***!
  \***********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductDisplay_vue_vue_type_template_id_91a5db04_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./ProductDisplay.vue?vue&type=template&id=91a5db04&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ProductDisplay.vue?vue&type=template&id=91a5db04&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductDisplay_vue_vue_type_template_id_91a5db04_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductDisplay_vue_vue_type_template_id_91a5db04_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);