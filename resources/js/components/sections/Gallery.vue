<template>
    <div class="product-showcase-product-view-wrapper section-space--pt_120" id="product">
        <div class="container-fluid container-fluid--cp-120">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-wrapper text-center section-space--pb_40">
                        <h2 class="section-title font-weight--blod wow move-up">Фото</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- gallery-warp Start -->
                    <div class="gallery-warp">
                        <div class="popup-images gallery-grid-4">

                            <silentbox-single
                                v-for="(photo, index) in gallery"
                                class="single-gallery"
                                :key="index"
                                v-bind:class="{'grid-width-2 grid-height-2': (index == 0)}"
                                :src="'/storage/files/mediafile/' + photo.id + '/' + photo.file"
                            >
                                <div class="single-gallery__item">
                                    <div class="single-gallery__thum">
                                        <img class="img-fluid" :src="'/storage/files/mediafile/' + photo.id + '/' + photo.file" />
                                    </div>
                                    <div class="ht-overlay"></div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-search"></i>
                                    </div>
                                </div>
                            </silentbox-single>

                        </div>
                    </div>
                    <!-- gallery-warp End -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Gallery',
    props: ['gallery']
}
</script>
