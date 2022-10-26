<template>
 
<div class="product-thumb">
    <!-- <span class="onsale">-25%</span> -->
    <div class="product-gallery">
        <div id="js-product-big" class="product-gallery__big  svg-block" :style="`background-image:  url(`+ image +`)`" 
        style="background-repeat: no-repeat;background-size: 100% auto;">
            
            <!-- <span v-if="svg === 'lady'">
            <svg  viewBox="0 0 942 1200">
                <path :style="'fill:' + prodColor" fill-rule="evenodd" id="Color_Fill_1" data-name="Color Fill 1" class="cls-1" d="M584,114c28.3-.415,66.962-0.677,89,8q7,231.477,14,463c-31.433,16.317-104.993,17.5-135-1q6-161.484,12-323,3-70.994,6-142c1.392-1.923.1-.6,2-2ZM407,552c28.542-.5,69.641-4,87,8q4.5,224.478,9,449c-34.6,26.68-97.668,25.23-135,2q2.5-160.985,5-322c0-18.573-1.294-119.482,4-127C382.428,551.257,395.1,556.311,407,552Z"/>
            </svg>
            </span>
            <span v-else>
              <svg viewBox="0 0 940 1200">
                  <path :style="'fill:' + prodColor" fill-rule="evenodd" id="Color_Fill_1" data-name="Color Fill 1" class="cls-1" d="M314,206c50.4,0.321,105.461-.286,156.206-0.033,1.938,0.01,2.869,3.021,4.794,3.033,0.307,2.147,1.924,4.7,2,7,0.67,20.147-1.82,44.276,1,64,4.406,30.821,10.216,56.549,26,76a40.569,40.569,0,0,0,9,8,39.932,39.932,0,0,0,7,3c5.581,2.129,30.148,2.039,48,2,24.047-.052,49.8,0,68,0,6.7,0,21.109-.017,31,0,10.892,0.018,17.106.268,20,5l9,29,17,28V927l-18,30a101.832,101.832,0,0,0-5,15c-1.568,5.979-1.2,14.543-5,17-105.323.333-212.677-.333-318,0-11.881,0-35.061-.471-55,0-8.851.209-23.5-.25-24,0a36.451,36.451,0,0,1-6.78.465c-8.238-.252-13.144-0.151-18.22-1.465-3.5-12.394-5.918-25.239-11-35-2.5-4.811-4.8-10.824-8-16-2.792-4.517-5.563-9.149-8-13V434l17-29,10-34c3.433-6.146,8.291-9.764,13-15,6.486-7.211,12.916-16.073,17-26,8.667-21.066,7.977-46.609,12-73V214C306.438,209.525,310.492,208.471,314,206Z"/>
                  <text fill="#fff" font-family="Calibri" font-weight="700" font-size="30px" id="Flavor_name" data-name="Flavor name" class="cls-2" x="393" y="818.5">Flavor name</text>
                  <text fill="#fff" font-family="Calibri" font-weight="700" font-size="60px" id="PUFFLEX" class="cls-3" x="361.25" y="564">PUFFLEX</text>
              </svg>
            </span> -->
 
        </div>

    </div>
</div>
                   
</template>

<script>
    export default {
        name: 'product-display',
          props: {
            image: {
                type: String,
                default: null
            },
            prodColor: {
              type: String,
              default: '#f0f0f0'
            },
            svg: {
              type: String,
              default: null
            }
        },
        data() {
            return {
                prodcolor: this.prodColor,
            }
        },
        computed: {
          
        },
        methods: {
        
        },
        mounted() {
          },
        created() {
           
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
input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}

</style>