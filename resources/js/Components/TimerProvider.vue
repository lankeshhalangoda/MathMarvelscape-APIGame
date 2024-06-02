<script setup>
import { ref, onMounted, provide, onUnmounted } from 'vue';

const timerSymbol = Symbol('timer');
const timer = ref(null);

onMounted(() => {
    provide(timerSymbol, timer);
});

onUnmounted(() => {
    clearInterval(timer);
});
</script>
