<template>
  <div id="app">
    <router-view />
  </div>
</template>

<script>
import { mapActions } from 'vuex';
export default {
  name: 'App',
  mounted() {
    const meta = document.querySelector('meta[name="csrf-token"]');
    if (meta) {
      const token = meta.getAttribute('content');
      this.setCSRF(token);
    }
  },
  methods: {
    ...mapActions(['setCSRF']),
  },
};
</script>
