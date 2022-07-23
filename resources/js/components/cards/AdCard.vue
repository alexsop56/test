<template>
    <div class="p-3">
        <b-card :title="item.title" :img-src="item.image"
            img-alt="Image" img-top tag="article" style="max-width: 20rem;" class="mb-2">

            <b-card-text>
                Цена: {{ item.price }}
            </b-card-text>

            <b-button href="#" variant="primary" @click="$emit('openModal', item.id)">Подробнее</b-button>
        </b-card>
    </div>
</template>

<script>
    export default {
        props: ["item"]
    }
</script>
