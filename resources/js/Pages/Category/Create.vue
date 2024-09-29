<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import { PhArrowUUpLeft, PhFloppyDiskBack } from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";
import { useForm } from "laravel-precognition-vue-inertia";
import FormInput from "@/Components/FormElements/FormInput.vue";
import CardContainer from "@/Components/Cards/CardContainer.vue";
import PrimaryButtonIcon from "@/Components/Buttons/PrimaryButtonIcon.vue";
import ComboboxSelector from "@/Components/Selectors/ComboboxSelector.vue";

const props = defineProps<{
    category: App.Data.CategoryData;
}>();

const title = "Δημιουργία κατηγορίας";

const form = useForm<App.Data.CategoryData>(
    "post",
    route("category.store"),
    props.category,
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

                <Breadcrumb :href="route('category.create')">
                    Δημιουργία
                </Breadcrumb>
            </Breadcrumbs>
        </template>

        <div class="mb-4 flex items-center justify-between">
            <div class="flex flex-col">
                <HeadingLarge> {{ title }}</HeadingLarge>
            </div>

            <div class="flex items-center gap-2">
                <AppLink :href="route('category.index')">
                    <IconSecondaryButton title="Επιστροφή">
                        <PhArrowUUpLeft weight="bold" />
                    </IconSecondaryButton>
                </AppLink>
            </div>
        </div>

        <form @submit.prevent="form.submit()">
            <CardContainer class="flex flex-col gap-4">
                <FormInput
                    id="text"
                    type="text"
                    label="Όνομα"
                    :required="true"
                    :autofocus="false"
                    :error="form.errors.name"
                    v-model="form.name"
                />

                <FormInput
                    id="description"
                    type="text"
                    label="Περιγραφή"
                    :required="false"
                    :autofocus="false"
                    :error="form.errors.description"
                    v-model="form.description"
                />

                <ComboboxSelector
                    api
                    id="products"
                    v-model="form.products"
                    multiple
                    zautofocus="false"
                    label="Προϊόντα"
                    :display-value-function="
                        (x: App.Data.ProductData) => x?.name
                    "
                    :route="route('api.product.index')"
                    :error="form.errors.products"
                />

                <ComboboxSelector
                    api
                    id="menu"
                    v-model="form.menuType"
                    label="Μενού"
                    :display-value-function="
                        (x: App.Data.MenuTypeData) => x?.name
                    "
                    :route="route('api.menu.index')"
                    :error="form.errors.menuType"
                />

                <div>
                    <PrimaryButtonIcon type="submit" title="Αποθήκευση">
                        <template #icon>
                            <PhFloppyDiskBack weight="fill" size="16" />
                        </template>
                        Αποθήκευση
                    </PrimaryButtonIcon>
                </div>
            </CardContainer>
        </form>
    </AuthenticatedLayout>
</template>
