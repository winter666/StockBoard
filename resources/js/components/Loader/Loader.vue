<template>
  <Loading
    :active="active"
    :can-cancel="false"
    :is-full-page="false"
    :color="'#42b983'"
  />
</template>

<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

export default {
  name: 'Loader',
  components: { Loading },
  props: {
    active: {
      type: Boolean,
      default: false,
    },
  },
};
</script>

<style scoped>

</style>
