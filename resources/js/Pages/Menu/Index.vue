<script setup lang="ts">
import { Head, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import PaginationMeta from "@/Components/Pagination/PaginationMeta.vue";
import MenuCard from "@/Models/MenuCard.vue";
import PaginationLinks from "@/Components/Pagination/PaginationLinks.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import AppLink from "@/Components/Links/AppLink.vue";
import { PhArchive, PhFiles, PhPlus } from "@phosphor-icons/vue";
import IconPrimaryButton from "@/Components/Buttons/IconPrimaryButton.vue";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";
import FormSearch from "@/Components/FormElements/FormSearch.vue";
import SecondaryButtonIcon from "@/Components/Buttons/SecondaryButtonIcon.vue";
import Draggable from "vuedraggable";
import EmptyState from "@/Components/EmptyStates/EmptyState.vue";
import PrimaryButtonIcon from "@/Components/Buttons/PrimaryButtonIcon.vue";

const title = "Κατάλογοι";

const props = defineProps<{
    menuTypes: LaravelPaginator<App.Data.Menu.MenuTypeData>;
    term: App.Data.Menu.MenuTypeIndexPageData;
}>();

//@ts-ignore
const term = ref<string>(props.term!);
const items = ref(props.menuTypes.data);

function reorder() {
    console.log('Route:', route("menu.reorder", { menuType: items.value[0].id }));
    console.log('First item:', items.value[0]);
    router.post(
        route("menu.reorder", { menuType: items.value[0].id }),  // Changed to menuType to match route parameter
        {
            options: items.value.map((item) => ({ id: item.id })),
        },
    );
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
                only: ["menuTypes"],
                onSuccess: () => items.value = props.menuTypes.data,
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
            </Breadcrumbs>
        </template>
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <HeadingLarge>{{ title }}</HeadingLarge>
                    <PaginationMeta :meta="menuTypes.meta" />
                </div>

                <div class="flex items-center gap-2">
                    <PaginationLinks
                        v-if="menuTypes?.meta?.total > 0"
                        :links="menuTypes.links"
                    />

                    <AppLink :href="route('menu.create')" title="Δημιουργία">
                        <IconPrimaryButton>
                            <PhPlus weight="bold" size="16" />
                        </IconPrimaryButton>
                    </AppLink>

                    <AppLink :href="route('menu.archived')" title="Αρχείο">
                        <SecondaryButtonIcon>
                            <template #icon>
                                <PhArchive weight="fill" size="16" />
                            </template>
                            Αρχείο
                        </SecondaryButtonIcon>
                    </AppLink>
                </div>
            </div>

            <template v-if="menuTypes.meta.total > 0">
                <FormSearch :clear-route="route('menu.index')" v-model="term" />

                <Draggable
                    v-if="items.length > 0"
                    v-model="items"
                    item-key="id"
                    @change="reorder"
                    :animation="200"
                    ghost-class="ghost"
                    drag-class="drag"
                    class="flex flex-col gap-2"
                >
                    <template #item="{ element }">
                        <MenuCard
                            is-draggable
                            :key="element.id!"
                            :menu-type="element"
                            class="transition-all duration-300 ease-in-out"
                        />
                    </template>
                </Draggable>
            </template>

            <EmptyState v-else>
                <template #icon>
                    <PhFiles size="44" />
                </template>
                <template #content>
                    Φαίνεται πως δεν υπάρχουν ενεργοί κατάλογοι
                </template>
                <template #action>
                    <AppLink :href="route('menu.create')" title="Δημιουργία">
                        <PrimaryButtonIcon>
                            <template #icon>
                                <PhPlus weight="bold" size="16" />
                            </template>
                            Προσθήκη
                        </PrimaryButtonIcon>
                    </AppLink>
                </template>
            </EmptyState>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.ghost {
    opacity: 0.5;
    background: #c8ebfb;
}

.drag {
    opacity: 0.8;
    transform: scale(1.05);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
</style>
