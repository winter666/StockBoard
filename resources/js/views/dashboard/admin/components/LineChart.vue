<template>
  <div :class="className" :style="{height:height,width:width}" />
</template>

<script>
import echarts from 'echarts';
require('echarts/theme/macarons'); // echarts theme
import { debounce } from '@/utils';

export default {
  props: {
    className: {
      type: String,
      default: 'chart',
    },
    width: {
      type: String,
      default: '100%',
    },
    height: {
      type: String,
      default: '350px',
    },
    autoResize: {
      type: Boolean,
      default: true,
    },
    chartData: {
      type: Object,
      required: true,
    },
    chartValues: {
      type: Array,
      required: true,
    },
    chartDays: {
      type: Array,
      required: true,
    },
    chartLegend: {
      type: Array,
      required: true,
    },
    chartName: {
      type: String,
      required: false,
      default: '',
    },
  },
  data() {
    return {
      chart: null,
      sidebarElm: null,
    };
  },
  watch: {
    chartData: {
      deep: true,
      handler(val) {
        this.setOptions(val);
      },
    },
  },
  mounted() {
    this.initChart();
    if (this.autoResize) {
      this.__resizeHandler = debounce(() => {
        if (this.chart) {
          this.chart.resize();
        }
      }, 100);
      window.addEventListener('resize', this.__resizeHandler);
    }

    // Monitor the sidebar changes
    this.sidebarElm = document.getElementsByClassName('sidebar-container')[0];
    this.sidebarElm && this.sidebarElm.addEventListener('transitionend', this.sidebarResizeHandler);
  },
  beforeDestroy() {
    if (!this.chart) {
      return;
    }
    if (this.autoResize) {
      window.removeEventListener('resize', this.__resizeHandler);
    }

    this.sidebarElm && this.sidebarElm.removeEventListener('transitionend', this.sidebarResizeHandler);

    this.chart.dispose();
    this.chart = null;
  },
  methods: {
    toggleActivate() {
      this.chart.dispatchAction({
        type: 'select',
      });
    },
    sidebarResizeHandler(e) {
      if (e.propertyName === 'width') {
        this.__resizeHandler();
      }
    },
    calculateSeries() {
      const colors = [
        { color: '#ADFF2F', fill: false },
        { color: '#FF005A', fill: false },
        { color: '#008000', fill: false },
        { color: '#4682B4', fill: false },
        { color: '#B22222', fill: false },
        { color: '#C71585', fill: false },
        { color: '#DAA520', fill: false },
        { color: '#9400D3', fill: false },
        { color: '#8B008B', fill: false },
        { color: '#4B0082', fill: false },
      ];

      const calcColor = (index) => {
        if (colors[index]) {
          return colors[index];
        } else {
          return colors[Math.round(Math.random() * (colors.length - 1))];
        }
      };

      return this.chartLegend.map((l, index) => {
        const { color } = calcColor(index);
        const data = this.chartData[l];
        return {
          name: l,
          itemStyle: {
            normal: {
              color: color,
              lineStyle: {
                color: color,
                width: 2,
              },
            },
          },
          smooth: true,
          type: 'line',
          data,
          animationDuration: 2800,
          animationEasing: 'cubicInOut',
        };
      });
    },
    setOptions() {
      const series = this.calculateSeries();
      const selected = {};
      this.chartLegend.forEach(v => {
        selected[v] = false;
      });
      const randomLegend = this.chartLegend[Math.round(Math.random() * (this.chartLegend.length - 1))];
      selected[randomLegend] = true;
      this.chart.setOption({
        xAxis: {
          data: this.chartDays,
          boundaryGap: false,
          axisTick: {
            show: false,
          },
        },
        grid: {
          left: 10,
          right: 35,
          bottom: 20,
          top: 60,
          containLabel: true,
        },
        title: {
          text: this.chartName,
        },
        tooltip: {
          trigger: 'axis',
          axisPointer: {
            type: 'cross',
          },
          padding: [5, 10],
        },
        yAxis: {
          axisTick: {
            show: false,
          },
        },
        legend: {
          type: 'scroll',
          left: 50,
          top: 30,
          data: this.chartLegend,
          selected,
        },
        series,
      });

      this.chart.dispatchAction({
        type: 'unselect',
        seriesName: this.chartLegend,
      });
    },
    initChart() {
      this.chart = echarts.init(this.$el, 'macarons');
      this.setOptions();
    },
  },
};
</script>
