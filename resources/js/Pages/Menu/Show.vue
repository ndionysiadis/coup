<script setup lang="ts">
import { Head, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import {
    PhArrowUUpLeft,
    PhPencilSimple,
    PhTrash,
    PhWarningCircle,
} from "@phosphor-icons/vue";
import CategoryCard from "@/Models/CategoryCard.vue";
import AppLink from "@/Components/Links/AppLink.vue";
import CardContainer from "@/Components/Cards/CardContainer.vue";
import { ref, watch } from "vue";
import PrimaryModal from "@/Components/Modals/PrimaryModal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/Buttons/SecondaryButton.vue";
import HeadingSmall from "@/Components/Texts/HeadingSmall.vue";
import FormSearch from "@/Components/FormElements/FormSearch.vue";
import debounce from "lodash/debounce";
import PaginationMeta from "@/Components/Pagination/PaginationMeta.vue";
import PaginationLinks from "@/Components/Pagination/PaginationLinks.vue";

const props = defineProps<{
    menuType: App.Data.Menu.MenuTypeData;
    categories: LaravelPaginator<App.Data.Category.CategoryData>;
    term: App.Data.Menu.MenuTypeShowPageData;
}>();

const modalOpen = ref<boolean>(false);

const title = props.menuType.name;

//@ts-ignore
const term = ref<string>(props.term!);
function destroy() {
    router.delete(route("menu.destroy", props.menuType), {
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
                only: ["categories"],
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
                <Breadcrumb first :href="route('menu.index')">
                    Κατάλογοι
                </Breadcrumb>

                <Breadcrumb :href="route('menu.show', menuType)">
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
                    <AppLink :href="route('menu.index')">
                        <IconSecondaryButton title="Επιστροφή">
                            <PhArrowUUpLeft weight="bold" />
                        </IconSecondaryButton>
                    </AppLink>

                    <AppLink :href="route('menu.edit', menuType)">
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
                        Διαγραφή καταλόγου: {{ menuType.name }}
                    </template>

                    <template #body>
                        Είστε σίγουροι ότι θέλετε να διαγράψετε το συγκεκριμένο
                        κατάλογο; Η διαγραφή θα γίνει μόνο στο κατάλογο και όχι
                        στις συνδεδεμένες κατηγορίες & προϊόντα.
                    </template>

                    <template #actions>
                        <SecondaryButton @click="modalOpen = false">
                            Άκυρο
                        </SecondaryButton>

                        <DangerButton @click="destroy"> Διαγραφή </DangerButton>
                    </template>
                </PrimaryModal>
            </div>

            <CardContainer class="mb-4">
                {{ menuType.description }}
            </CardContainer>

            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <HeadingSmall>Κατηγορίες</HeadingSmall>
                    <PaginationMeta :meta="categories.meta" />
                </div>

                <PaginationLinks
                    v-if="categories?.meta?.total > 0"
                    :links="categories.links"
                />
            </div>

            <FormSearch
                :clear-route="route('menu.show', menuType)"
                v-model="term"
            />

            <div class="flex flex-col gap-2">
                <CategoryCard
                    v-for="category in categories.data"
                    :key="category.id!"
                    :category="category"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
