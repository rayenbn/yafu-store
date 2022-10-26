<template>
    <section class="section-single-product product">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="product-thumb">
                        <!-- <span class="onsale">-25%</span> -->
                        <div class="product-gallery">
                            <div id="js-product-big" class="product-gallery__big">
                                <div id="imgReader">
                                </div>
                                <video v-if="videoDisplay" width="100%" controls controlsList="nodownload" class="video-max-height" autoplay muted>
                                    <source :src="productVideo" type="video/mp4">
                                    <source :src="productVideo" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                                <img v-else :src="productImage" alt="" id="videoReader" />
                             

                            </div>
                            <div id="js-product-nav mt-4" class="product-gallery-thumbs">
                                <div v-if="productVideo != null" class="product-gallery-thumbs__item active" 
                                    :data-large-src="productVideo"
                                    @click.prevent="changeVideo(productVideo, 100)"
                                    id="100"
                                >
                                    <div class="video-thumbnail">
                                        <img :src="'/storage/products/thumbnail/'+ product.img" alt="">
                                        <i class="flaticon-video-player-pause-button video-icon"></i>
                                    </div>
                                </div>

                                <div class="product-gallery-thumbs__item " 
                                    v-for="(image, index) in images"  :key="'image-' + index"
                                    :data-large-src="'/storage/products/thumbnail/'+image.productImages"
                                    :class="(index == 0 && !productVideo)? 'active' : ''"
                                    :id="index"
                                    @click.prevent="changeImage(image.productImages, index)"
                                    >
                                    <img :src="'/storage/products/thumbnail/'+image.productImages">
                                </div>
                                <!-- <div class="product-gallery-thumbs__item" data-large-src="images/470x600.png">
                                    <img src="images/100x130.png" alt="">
                                </div> -->
            
                               
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-summary summary col-lg-7">
                    <h1 class="h2 product-title">{{ product.name }}</h1>

                    <div class="price">
                        <ins>Unit Price: 
                            <!-- <span v-if="hasAuthUser" class="amount">$ {{ formatPrice(totalprice) }}</span> -->
                            <span v-if="hasAuthUser" class="amount">$ N/A</span>
                            <span v-else class="amount"><a href="/login">Login to see price</a></span>
                        </ins>
                        <br>
                        <ins>Total
                                <!-- <span v-if="hasAuthUser" class="amount">$ {{ formatPrice(totalprice * quantity) }}</span> -->
                                <span v-if="hasAuthUser" class="amount">$ N/A</span>
                            <span v-else class="amount"><a href="/login">Login to see price</a></span>
                        </ins>
                    </div>

                    <div class="cart-form__item quantity quantity" v-if="product">
                        <span>Availability:</span>
                        <span class="success" v-if="product.availability == 0">Available</span>
                        <span class="success" v-if="product.availability == 1">Not Available</span>
                        <span class="success" v-if="product.availability == 2">Pre Order</span>
                    </div>

                    <form action="/" class="cart-form">
                        <div class="cart-form__item quantity quantity">
                            <label for="quantity">Qty:</label>
                            <input type="text" class="input-text qty-1" title="Qty"
                            v-model.number="quantity" 
                            @change.prevent="quantityChange"
                            @keydown.enter.prevent="quantityChange"
                            maxlength="12"
                            id="qty" name="qty">
                        </div>

                        <template v-if="colors.length > 0"  >
                            <div class="color-variants">
                                <div>Color: <span id="active-color">{{ prodcolor ?  prodcolor.color_name  : ''}}</span></div>
                                <ul class="colors-list">
                                    <li class="colors-list__item"
                                        v-for="(color, index) in colors" 
                                        :key="'color' + index"
                                        :class="prodcolor ? (prodcolor.color_code == color.color_code ? 'colors-list__item_active' : '') : ''"
                                    >
                                        <a @click="colorChange(color)" style="cursor: pointer;"><span class="prod-color" :style="'background-color: ' + color.color_code"></span></a>
                                    </li>
                                    <!-- <li class="colors-list__item"><a href="single-product.html"><span class="prod-color" style="background-color: #333339"></span></a></li> -->
                                </ul>
                            </div>
                        </template>

                        <div class="row">
                            <template v-for="(type, index) in types"  >
                                <div class="form-group mb-10 col-md-6" :key="index">
                                    <label :key="'typenane' + index" for="type">{{ type.name }}</label>
                                    <select class="form-control active" :key="'type' + index"
                                        v-model="prodtypes[index]"
                                        @change="typeChange"
                                        name="type"
                                    >
                                        <option 
                                            v-for="(variant, index) in type.variants" 
                                            v-bind:value="variant" 
                                            v-bind:key="'variant' + index"
                                        >
                                            {{ variant.name }}
                                        </option>
                                    </select>
                                </div>
                            </template>
                        </div>
                        <template v-if="haslogo == 1"  >
                            <label for="img" class="col-form-label ">Upload custom logo!</label>
                            <br>
                            <label for="file-upload" class="custom-file-upload">
                                <i class="flaticon flaticon-cloud-upload"></i> Upload file!
                            </label>
                            <input id="file-upload" type="file" @change="UploadFile" >

                        </template>
                        
                    </form>

                    <button v-if="hasAuthUser" class="btn btn-primary btn-lg add_to_cart_button" title="Add to Cart" type="button" @click="saveBatch">
                        <em class="fa-icon"><i class="fa fa-shopping-cart"></i></em>
                        <span>Add Cart</span>
                    </button>
                    <button v-else class="btn btn-primary btn-lg add_to_cart_button" @click="redirectToLogin">
                        <em class="fa-icon"><i class="fa fa-shopping-cart"></i></em>
                        <span>Add Cart</span>
                    </button>

                    <div class="product-summary__featured">
                        <div class="row">
                            <!-- <div class="product-featured-item">
                                <div class="icon-box icon-box-left icon-box-circle">
                                    <div class="icon-box__icon"><i class="flaticon flaticon-delivery-truck"></i></div>
                                    <div class="icon-box__title">Free shipping</div>
                                </div>
                            </div> -->
                            <div class="product-featured-item">
                                <div class="icon-box icon-box-left icon-box-circle">
                                    <div class="icon-box__icon"><i class="flaticon flaticon-blocked-padlock"></i></div>
                                    <div class="icon-box__title">100% quality guaranteed</div>
                                </div>
                            </div>
                            <div class="product-featured-item">
                                <div class="icon-box icon-box-left icon-box-circle">
                                    <div class="icon-box__icon"><i class="flaticon flaticon-sales-ticket"></i></div>
                                    <div class="icon-box__title">1 year free warranty!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <template v-if="social_media && (social_media.youtube || social_media.fb || social_media.ig || social_media.twitter)" >
                        <div class="product-summary__share">
                            <div>Share:</div>

                            <ul class="social-links">
                                <li v-if="social_media && social_media.youtube"><a :href="social_media.youtube ? social_media.youtube : ''"><i class="mdi mdi-youtube-play"></i></a></li>
                                <li v-if="social_media && social_media.fb"><a :href="social_media.fb ? social_media.fb : ''"><i class="mdi mdi-facebook"></i></a></li>
                                <li v-if="social_media && social_media.ig"><a :href="social_media.ig"><i class="mdi mdi-instagram"></i></a></li>
                                <li v-if="social_media && social_media.twitter"><a :href="social_media.twitter"><i class="mdi mdi-twitter"></i></a></li>
                            </ul>
                        </div>
                    </template>

                    <!-- <div class="description-block">
                        <h3 class="mb-30">Description</h3>

                        <div class="product-description">
                            <p>Dutch Bag crafts high quality tees and accessories that are comfortable,
                                stylish, and imbued with the laid back spirit of Taffle. Comfortably holds
                                your sneakers and your laptop in addition to a plethora of other
                                necessities, while keeping everything organized and well protected.
                            </p>
                        </div>
                    </div>
                    <div class="product-attributes">
                        <div class="product-attributes__item">
                            <strong>Material:</strong>
                            Body — 100% cotton trims / other — 100% polyurethane.
                        </div>
                        <div class="product-attributes__item">
                            <strong>Care:</strong>
                            Wipe clean with a damp sponge, do not dry clean, do not iron
                        </div>
                    </div> -->
                </div>
                <div class="description-block" v-if="product.description">
                    <h3 class="mb-30">Description</h3>

                    <div class="product-description" v-html="product.description">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>


</template>

<script>
    export default {
        name: 'product',
        props: {
            product: {
                type: Object,
                default: null
            },
            prod_categories: {
                type: Array,
                default: []
            },
            types: {
                type: Array,
                default: []
            },
            colors: {
                type: Array,
                default: []
            },
            images: {
               type: Array,
                default: []
            },
            social_media: {
                type: Object,
                default: null
            },
            user: {
                type: Object,
                default: () => {
                    return null;
                }
            },
            
        },
        data() {
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
                productVideo: null,
                haslogo: 0,
                logoprice: 0,
                logofile: null,
                videoDisplay: false
            }
        },
        computed: {
          hasAuthUser() {
                if (! this.user) {
                    return false;
                }

                return Object.keys(this.user).length > 0;
            },
        },
        methods: {
          
            changeImage(image,index){
                
                if (this.videoDisplay){
                    this.videoDisplay = false;
                }
                // var videoDisplaySection = document.getElementById("videoReader");
                // if (videoDisplaySection.style.display === "block") {
                //     videoDisplaySection.style.display = "none";
                // } 
                
                // // videoDisplaySection.classList.add('d-none');
                // var imgDisplaySection = document.getElementById("imgReader");
                // if (imgDisplaySection.style.display === "none") {
                //     imgDisplaySection.style.display = "block";
                // } 
                // // imgDisplaySection.classList.add('d-block');

                this.productImage = '/storage/products/'+image;

                var prevThumb = document.querySelector('.active');
                prevThumb.classList.remove('active');
                var thumb = document.getElementById(index);
                thumb.classList.add('active');
                // console.log(prevThumb);
                // Remove active class from thumbs
                // thumbs.each(function() {
                //     if( $(this).hasClass('is-active') ) {
                //     $(this).removeClass('is-active');
                //     }
                // });
            },
            changeVideo(video, index){

                if (!this.videoDisplay){
                    this.videoDisplay = true;
                }

                // var imgDisplaySection = document.getElementById("imgReader");
                // if (imgDisplaySection.style.display === "block") {
                //     imgDisplaySection.style.display = "none";
                // } 

                // var videoDisplaySection = document.getElementById("videoReader");
                // if (videoDisplaySection.style.display === "none") {
                //     videoDisplaySection.style.display = "block";
                // } 


                this.productVideo = video;

                var prevThumb = document.querySelector('.active');
                prevThumb.classList.remove('active');
                var thumb = document.getElementById(index);
                thumb.classList.add('active');

                // console.log(prevThumb);
                // Remove active class from thumbs
                // thumbs.each(function() {
                //     if( $(this).hasClass('is-active') ) {
                //     $(this).removeClass('is-active');
                //     }
                // });
            },

            //Function to generate video thumbnail
            generateVideoThumbnail (file) {
                return new Promise((resolve) => {
                const canvas = document.createElement("canvas");
                const video = document.createElement("video");
            
                // this is important
                video.autoplay = true;
                video.muted = true;
                video.src = URL.createObjectURL(file);
            
                video.onloadeddata = () => {
                    let ctx = canvas.getContext("2d");
            
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
            
                    ctx.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
                    video.pause();
                    return resolve(canvas.toDataURL("image/png"));
                };
                });
            },

            initOrder() {
                if (this.product) {
                    this.prodId = this.product.id;
                    this.haslogo = this.product.haslogo;
                    this.logoprice = this.product.logoprice;
                    this.price = this.product.discount_price ? parseFloat(this.product.discount_price) : parseFloat(this.product.price);
                    this.prodcolor = this.colors[0];
                    this.productImage = '/storage/products/'+ this.images[0].productImages;
                    
                    if (this.product.video){
                        this.productVideo = '/storage/products/'+ this.product.video;
                        this.videoDisplay = true;
                    }

                    if (this.types.length > 0){
                        // this.typesTotalPrice = 0;
                        for (let i = 0; i < this.types.length; i++){
                            this.prodtypes.push(this.types[i].variants[0]);
                            
                        }
                    }
                }
            },
            UploadFile(e){
                var file = e.target.files[0];

                var formfile = new FormData();
                formfile.set('logofile', file);
                axios.post('/upload-logo', formfile)
                .then((response) => {
                    this.logofile = response.data;
                     this.$swal('Done','Your file has been successfully uploaded!', 'success');
                   
                })
                .catch((error) => {
                     this.$swal('Error!','Error happening during uploading your file!', 'error');
                }); 

            },
            recalculatePrice(){
                if (this.prodtypes.length > 0){
                    this.typesTotalPrice = 0;
                    for (let i = 0; i < this.prodtypes.length; i++){
                        this.typesTotalPrice += this.prodtypes[i].price;
                        
                    }
                }

                this.totalprice = this.price 
                    + (this.prodcolor ? this.prodcolor.price : 0)
                    + this.typesTotalPrice;

                return 
            },

            colorChange(color) {
                // this.svgColor = color.color_code;
                this.prodcolor = color;
                this.recalculatePrice();
            },
            typeChange(event) {
                this.recalculatePrice();
            },
            quantityChange(event){

            },
            increaseQty(){
                this.quantity += 1;
            },
            decreaseQty(){
                if (this.quantity > 1)
                    this.quantity -= 1;
            },
            saveBatch() {
               
               var formData = new FormData();

                formData.append('id', this.prodId);
                formData.append('quantity',this.quantity);
                formData.append('prodcolor', this.prodcolor ? JSON.stringify(this.prodcolor) : null);
                formData.append('prodtypes', this.prodtypes ? JSON.stringify(this.prodtypes) : null);
                formData.append('logofile', this.logofile ? this.logofile : null);
           
                axios.post('/add-to-cart', formData)
                .then((response) => {
                    setTimeout(() => {
                        window.location.href = "/cart";
                    }, 1000);
                })
                .catch((error) => {
                    self.issummaring = 0;
                    this.savingStatus = true;
                }); 

                // this.$store.dispatch('CustomProductConfigurator/saveBatch')
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
            redirectToLogin() {
                window.location.href = "/login";
            },
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            }
        },
        mounted() {
            this.initOrder();
            this.recalculatePrice();
        },
        created() {
            //=== Private Variables ===//
            var gallery = $('#js-gallery');

            //=== Gallery Object ===//
            var Gallery = {
                zoom: function(imgContainer, img) {
                var containerHeight = imgContainer.outerHeight(),
                src = img.attr('src');
                
                if ( src.indexOf('/products/normal/') != -1 ) {
                    // Set height of container
                    imgContainer.css( "height", containerHeight );
                    
                    // Switch hero image src with large version
                    img.attr('src', src.replace('/products/normal/', '/products/zoom/') );
                    
                    // Add zoomed class to gallery container
                    gallery.addClass('is-zoomed');
                    
                    // Enable image to be draggable
                    img.draggable({
                    drag: function( event, ui ) {
                        ui.position.left = Math.min( 100, ui.position.left );
                        ui.position.top = Math.min( 100, ui.position.top );
                    }
                    });
                } else {
                    // Ensure height of container fits image
                    imgContainer.css( "height", "auto" );
                    
                    // Switch hero image src with normal version
                    img.attr('src', src.replace('/products/zoom/', '/products/normal/') );
                    
                    // Remove zoomed class to gallery container
                    gallery.removeClass('is-zoomed');
                }
                },
                switch: function(trigger, imgContainer) {
                var src = trigger.attr('href'),
                thumbs = trigger.siblings(),
                        img = trigger.parent().prev().children();
                
                // Add active class to thumb
                trigger.addClass('is-active');
                
                // Remove active class from thumbs
                thumbs.each(function() {
                    if( $(this).hasClass('is-active') ) {
                    $(this).removeClass('is-active');
                    }
                });

                // Reset container if in zoom state
                if ( gallery.hasClass('is-zoomed') ) {
                    gallery.removeClass('is-zoomed');
                    imgContainer.css( "height", "auto" );
                }

                // Switch image source
                img.attr('src', src);
                }
            };
        }
    }
</script>
<style scoped>
/* img {
  max-width: 100%;
} */


/**
 * Helper Styles
 */
.ir {
  text-indent: 100%;
  white-space: nowrap;
  overflow: hidden;
}
    /**
 * Gallery Styles
 * 1. Enable fluid images
 */
.gallery {
  overflow: hidden;
}

.gallery__hero {
  overflow: hidden;
  position: relative;
  padding: 2em;
  margin: 0 0 0.3333333333em;
  background: #fff;
}
.is-zoomed .gallery__hero {
  cursor: move;
}
.is-zoomed .gallery__hero img {
  max-width: none;
  position: absolute;
  z-index: 0;
  top: -50%;
  left: -50%;
}

.gallery__hero-enlarge {
  position: absolute;
  right: 0.5em;
  bottom: 0.5em;
  z-index: 1;
  width: 30px;
  height: 30px;
  opacity: 0.5;
  background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzMCIgaGVpZ2h0PSIzMCIgdmlld0JveD0iNS4wIC0xMC4wIDEwMC4wIDEzNS4wIiBmaWxsPSIjMzRCZjQ5Ij48cGF0aCBkPSJNOTMuNTkzIDg2LjgxNkw3Ny4wNDUgNzAuMjY4YzUuNDEzLTYuODczIDguNjQyLTE1LjUyNiA4LjY0Mi0yNC45MTRDODUuNjg3IDIzLjEwNCA2Ny41OTMgNSA0NS4zNDMgNVM1IDIzLjEwNCA1IDQ1LjM1NGMwIDIyLjI0IDE4LjA5NCA0MC4zNDMgNDAuMzQzIDQwLjM0MyA5LjQgMCAxOC4wNjItMy4yNCAyNC45MjQtOC42NTNsMTYuNTUgMTYuNTZjLjkzNy45MjcgMi4xNjIgMS4zOTYgMy4zODggMS4zOTYgMS4yMjUgMCAyLjQ1LS40NyAzLjM5LTEuMzk2IDEuODc0LTEuODc1IDEuODc0LTQuOTEyLS4wMDItNi43ODh6bS00OC4yNS0xMC43MWMtMTYuOTU0IDAtMzAuNzUzLTEzLjc5OC0zMC43NTMtMzAuNzUyIDAtMTYuOTY0IDEzLjgtMzAuNzY0IDMwLjc1My0zMC43NjQgMTYuOTY0IDAgMzAuNzUzIDEzLjggMzAuNzUzIDMwLjc2NCAwIDE2Ljk1NC0xMy43ODggMzAuNzUzLTMwLjc1MyAzMC43NTN6TTYzLjAzMiA0NS4zNTRjMCAyLjM0NC0xLjkwNyA0LjI2Mi00LjI2MiA0LjI2MmgtOS4xNjR2OS4xNjRjMCAyLjM0NC0xLjkwNyA0LjI2Mi00LjI2MiA0LjI2Mi0yLjM1NSAwLTQuMjYyLTEuOTE4LTQuMjYyLTQuMjYydi05LjE2NGgtOS4xNjRjLTIuMzU1IDAtNC4yNjItMS45MTgtNC4yNjItNC4yNjIgMC0yLjM1NSAxLjkwNy00LjI2MiA0LjI2Mi00LjI2Mmg5LjE2NHYtOS4xNzVjMC0yLjM0NCAxLjkwNy00LjI2MiA0LjI2Mi00LjI2MiAyLjM1NSAwIDQuMjYyIDEuOTE4IDQuMjYyIDQuMjYydjkuMTc1aDkuMTY0YzIuMzU1IDAgNC4yNjIgMS45MDcgNC4yNjIgNC4yNjJ6Ii8+PC9zdmc+);
  background-repeat: no-repeat;
  transition: opacity 0.3s cubic-bezier(0.455, 0.03, 0.515, 0.955);
}
.gallery__hero-enlarge:hover {
  opacity: 1;
}
.is-zoomed .gallery__hero-enlarge {
  background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzMCIgaGVpZ2h0PSIzMCIgdmlld0JveD0iNS4wIC0xMC4wIDEwMC4wIDEzNS4wIiBmaWxsPSIjMzRCZjQ5Ij48cGF0aCBkPSJNOTMuNTkzIDg2LjgxNkw3Ny4wNDUgNzAuMjY4YzUuNDEzLTYuODczIDguNjQyLTE1LjUyNiA4LjY0Mi0yNC45MTRDODUuNjg3IDIzLjEwNCA2Ny41OTMgNSA0NS4zNDMgNVM1IDIzLjEwNCA1IDQ1LjM1NGMwIDIyLjI0IDE4LjA5NCA0MC4zNDMgNDAuMzQzIDQwLjM0MyA5LjQgMCAxOC4wNjItMy4yNCAyNC45MjQtOC42NTNsMTYuNTUgMTYuNTZjLjkzNy45MjcgMi4xNjIgMS4zOTYgMy4zODggMS4zOTYgMS4yMjUgMCAyLjQ1LS40NyAzLjM5LTEuMzk2IDEuODc0LTEuODc1IDEuODc0LTQuOTEyLS4wMDItNi43ODh6TTE0LjU5IDQ1LjM1NGMwLTE2Ljk2NCAxMy44LTMwLjc2NCAzMC43NTMtMzAuNzY0IDE2Ljk2NCAwIDMwLjc1MyAxMy44IDMwLjc1MyAzMC43NjQgMCAxNi45NTQtMTMuNzkgMzAuNzUzLTMwLjc1MyAzMC43NTMtMTYuOTUzIDAtMzAuNzUzLTEzLjgtMzAuNzUzLTMwLjc1M3pNNTguNzcyIDQ5LjYxSDMxLjkyYy0yLjM1NSAwLTQuMjYzLTEuOTA3LTQuMjYzLTQuMjZzMS45MDgtNC4yNjMgNC4yNjItNC4yNjNINTguNzdjMi4zNTQgMCA0LjI2MiAxLjkwOCA0LjI2MiA0LjI2MnMtMS45MSA0LjI2LTQuMjYyIDQuMjZ6Ii8+PC9zdmc+);
}

.gallery__thumbs {
  text-align: center;
  background: #333;
}
.gallery__thumbs a {
  display: inline-block;
  width: 20%;
  padding: 0.5em;
  opacity: 0.75;
  transition: opacity 0.3s cubic-bezier(0.455, 0.03, 0.515, 0.955);
}
.gallery__thumbs a:hover {
  opacity: 1;
}
.gallery__thumbs a.is-active {
  opacity: 0.2;
}

.video-thumbnail {
    position: relative;
}
.video-icon {
    position: absolute;
    top: 33%;
    right: 33%;
    font-size: 26px;
    color: #65f0d9;
}
.video-max-height {
    max-height: 600px;
}
</style>