<script setup lang="ts">
import { Head, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import {
    PhArrowUUpLeft,
    PhChefHat,
    PhPencilSimple,
    PhTrash,
    PhWarningCircle,
} from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";
import CardContainer from "@/Components/Cards/CardContainer.vue";
import { ref, watch } from "vue";
import PrimaryModal from "@/Components/Modals/PrimaryModal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/Buttons/SecondaryButton.vue";
import ProductCard from "@/Models/ProductCard.vue";
import TextLink from "@/Components/Links/TextLink.vue";
import HeadingSmall from "@/Components/Texts/HeadingSmall.vue";
import debounce from "lodash/debounce";
import FormSearch from "@/Components/FormElements/FormSearch.vue";
import PaginationMeta from "@/Components/Pagination/PaginationMeta.vue";
import PaginationLinks from "@/Components/Pagination/PaginationLinks.vue";

const props = defineProps<{
    category: App.Data.Category.CategoryShowPageData;
    products: LaravelPaginator<App.Data.Product.ProductData>;
    term: App.Data.Category.CategoryShowPageData;
}>();

const modalOpen = ref<boolean>(false);

const title = props.category.name;

const term = ref<string>(props.term!);

function destroy() {
    router.delete(route("category.destroy", props.category), {
        preserveState: true,
        preserveScroll: true,
        only: ["toast"],
    });
}

watch(
    term,
    debounce((value) => {
        let fullUrl: string = window.location.href;
        let url: URL = new URL(fullUrl);
        let params: URLSearchParams = new URLSearchParams(url.search);

        params.set("term", value);

        url.search = params.toString();
        router.get(
            url.href,
            {},
            {
                preserveState: true,
                only: ["products"],
            },
        );
    }, 1000),
);
</script>

<template>
    <Head :title="title" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <Breadcrumbs>
                <Breadcrumb first :href="route('category.index')">
                    Κατηγορίες
                </Breadcrumb>

                <Breadcrumb :href="route('category.show', category)">
                    {{ title }}
                </Breadcrumb>
            </Breadcrumbs>
        </template>
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <HeadingLarge> {{ title }}</HeadingLarge>
                </div>

                <div class="flex items-center gap-2">
                    <AppLink :href="route('category.index')">
                        <IconSecondaryButton title="Επιστροφή">
                            <PhArrowUUpLeft weight="bold" />
                        </IconSecondaryButton>
                    </AppLink>

                    <AppLink :href="route('category.edit', category)">
                        <IconSecondaryButton title="Επεξεργασία">
                            <PhPencilSimple weight="fill" />
                        </IconSecondaryButton>
                    </AppLink>

                    <IconSecondaryButton
                        title="Διαγραφή"
                        @click="modalOpen = !modalOpen"
                    >
                        <PhTrash weight="fill" />
                    </IconSecondaryButton>
                </div>

                <PrimaryModal :open="modalOpen" @closeModal="modalOpen = false">
                    <template #icon>
                        <PhWarningCircle weight="bold" size="24" />
                    </template>

                    <template #title>
                        Διαγραφή κατηγορίας: {{ category.name }}
                    </template>

                    <template #body>
                        Είστε σίγουροι ότι θέλετε να διαγράψετε τη συγκεκριμένη
                        κατηγορία; Η διαγραφή θα γίνει μόνο στη κατηγορία και
                        όχι στα συνδεδεμένα μενού & προϊόντα.
                    </template>

                    <template #actions>
                        <SecondaryButton @click="modalOpen = false">
                            Άκυρο
                        </SecondaryButton>

                        <DangerButton @click="destroy"> Διαγραφή </DangerButton>
                    </template>
                </PrimaryModal>
            </div>

            <CardContainer class="mb-4 flex flex-col gap-2">
                <div v-if="category.menuType" class="flex items-center gap-1">
                    <PhChefHat size="16" weight="bold" />
                    <TextLink :href="route('menu.show', category.menuType)">
                        {{ category.menuType.name }}
                    </TextLink>
                </div>

                <div>
                    {{ category.description }}
                </div>
            </CardContainer>

            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <HeadingSmall>Products</HeadingSmall>
                    <PaginationMeta :meta="products.meta" />
                </div>

                <PaginationLinks
                    v-if="products?.meta?.total > 0"
                    :links="products.links"
                />
            </div>

            <FormSearch
                :clear-route="route('category.show', category)"
                v-model="term"
            />

            <div class="flex flex-col gap-2">
                <ProductCard
                    v-for="product in products.data"
                    :key="product.id"
                    :product="product"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
