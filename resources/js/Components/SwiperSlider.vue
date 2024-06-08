<template>
    <swiper
      :modules="modules"
      :slides-per-view="3"
      :space-between="50"
      :pagination="{ clickable: true }"
      @swiper="onSwiper"
      @slideChange="onSlideChange"
    >
        <swiper-slide v-for="(item, index) in items" :key="index">
            <DonationCard />
        </swiper-slide>
    </swiper>
  </template>
  <script>
    // import Swiper core and required modules
    import { Navigation, Pagination, Scrollbar, A11y } from 'swiper/modules';
  
    // Import Swiper Vue.js components
    import { Swiper, SwiperSlide } from 'swiper/vue';
  
    // Import Swiper styles
    import 'swiper/css';
    import 'swiper/css/navigation';
    import 'swiper/css/pagination';
    import 'swiper/css/scrollbar';
    import DonationCard from './DonationCard.vue';
  
    // Import Swiper styles
    export default {
      components: {
        Swiper,
        SwiperSlide,
        DonationCard,
      },
      props: {
        items: Array,
      },
      setup() {
        const onSwiper = (swiper) => {
        };
        const onSlideChange = () => {
        };
        return {
          onSwiper,
          onSlideChange,
          modules: [Navigation, Pagination, Scrollbar, A11y],
        };
      },
    };
  </script>