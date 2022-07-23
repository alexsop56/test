<template>
    <div>
        <div class="container">
            <header class="pt-5">
                <nav>
                    <button class="btn btn-success" @click="modalCreateAd.status = true">Добавить</button>

                    <b-form-select class="mx-3" v-model="sort_by" :options="sortByOptions" />
                    <b-form-select class="mx-3" v-model="sort_dir" :options="sortDirOptions" />
                </nav>
            </header>

            <hr class="my-4" />

            <div class="row">
                <ad-card class="col-lg-3" v-for="(ad, key) in ads" :key="'ad_card_' + key" :item="ad" @openModal="openModal" />
            </div>

            <div class="pagination-buttons">
                <button class="btn mx-2" :class="{ 'btn-primary': pageNumber == page }" 
                v-for="pageNumber in buttonsCount" :key="'number_' + pageNumber"
                @click="page = pageNumber">{{ pageNumber }}
                </button>
            </div>
        </div>

        <b-modal v-model="modalCreateAd.status" hide-header hide-footer centered>
            <b-form-input class="mb-3" v-model="modalCreateAd.temp.title" placeholder="Название" :disabled="!!modalCreateAd.temp.id" />

            <b-form-textarea
                id="textarea"
                v-model="modalCreateAd.temp.description"
                placeholder="Описание..."
                rows="3"
                max-rows="6"
                class="mb-3"
                :disabled="!!modalCreateAd.temp.id"
            /> 

            <div class="d-flex" v-if="!modalCreateAd.temp.id">
                <b-form-input class="mb-3" v-model="modalCreateAd.insertedRef" placeholder="Ссылка" />
                <button class="btn btn-primary h-25 mx-1" @click="addRef">Добавить</button>
            </div>

            <div class="d-flex" v-for="(ref, key) in modalCreateAd.temp.images" :key="'ref_' + key">
                <b-form-input class="mb-3" v-model="modalCreateAd.temp.images[key]" placeholder="Ссылка" :disabled="!!modalCreateAd.temp.id" />
                <button class="btn btn-danger h-25 mx-1" @click="removeRef(key)" v-if="!modalCreateAd.temp.id">Удалить</button>
            </div>

            <b-form-input class="mb-3" v-model="modalCreateAd.temp.price" placeholder="Цена" :disabled="!!modalCreateAd.temp.id" />

            <button class="btn btn-success" @click="createAd" v-if="!modalCreateAd.temp.id">Создать объявление</button>
        </b-modal>

        <notifications class="m-3" />
    </div>
</template>

<script>

export default {
    data() {
        return {
            ads: [],

            page: 1,
            pagesCount: 0,

            sortByOptions: [
                { text: "Цена", value: "price" },
                { text: "Дата создания", value: "created_at" }
            ],
            sortDirOptions: [
                { text: "По возрастанию", value: "asc" },
                { text: "По убыванию", value: "desc" }
            ],
            sort_by: "price",
            sort_dir: "desc",

            modalCreateAd: {
                status: false,
                temp: {
                    title: null,
                    description: null,
                    images: [],
                    price: 0,
                },
                insertedRef: null
            }
        };
    },
    methods: {
        async refresh() {
            var adsInfo = await this.getAdsInfo();

            this.ads = adsInfo.data;
            this.pagesCount = adsInfo.pagination.total_pages;
        },
        async getAdsInfo() {
            var response = await this.getAdsRequest();
            return response.data;
        },
        getAdsRequest() {
            var params = {
                page: this.page,
                sort_by: this.sort_by,
                sort_dir: this.sort_dir
            };

            var url = route("ad.index", params);
            return this.axios.get(url);
        },
        async createAd() {
            var url = route("ad.store");
            this.axios.post(url, this.modalCreateAd.temp)
                .then((response) => {
                    this.$notify("Объявление успешно создано");
                    this.refresh();
                    this.clearModal();
                })
                .catch((e) => {
                    var errorMessage = e.response.data.message;

                    this.$notify({
                        type: "error",
                        text: errorMessage
                    });
                });
        },
        clearModal() {
            this.modalCreateAd = {
                status: false,
                temp: {
                    title: null,
                    description: null,
                    images: [],
                    price: 0,
                },
                insertedRef: null
            };
        },
        addRef() {
            if(!this.modalCreateAd.insertedRef) {
                this.$notify('Укажите ссылку');
                return;
            }

            this.modalCreateAd.temp.images.push(this.modalCreateAd.insertedRef);

            this.modalCreateAd.insertedRef = null;
        },
        removeRef(removedKey) {
            this.modalCreateAd.temp.images = this.modalCreateAd.temp.images.filter((url, key) => {
                return key != removedKey;
            });
        },
        openModal(adId) {
            var url = route("ad.show", { ad: adId, fields: ["description", "images"] });
            this.axios.get(url).then((response) => {
                this.modalCreateAd.temp = response.data;
                this.modalCreateAd.status = true;
            });
        }
    },
    mounted() {
        this.refresh();
    },
    computed: {
        buttonsCount() {
            var buttons = [];

            while(buttons.length < this.pagesCount) {
                buttons.push(buttons.length + 1);
            }

            return buttons;
        }
    },
    watch: {
        page() {
            this.refresh();
        },
        "modalCreateAd.status"(status) {
            if(!status) {
                this.clearModal();
            }
        },
        sort_by() {
            this.refresh();
        },
        sort_dir() {
            this.refresh();
        }
    }
}
</script>