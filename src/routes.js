import Home from './routes/Home.svelte';
import Lorem from './routes/Lorem.svelte';
import NotFound from './routes/404.svelte';

export default {
    '/': Home,
    '/lorem/:repeat': Lorem,
    // The catch-all route must always be last
    '*': NotFound
};
