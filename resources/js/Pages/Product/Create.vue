<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import {
    PhArrowUUpLeft,
    PhCurrencyEur,
    PhFloppyDiskBack,
} from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";
import { useForm } from "laravel-precognition-vue-inertia";
import FormInput from "@/Components/FormElements/FormInput.vue";
import CardContainer from "@/Components/Cards/CardContainer.vue";
import PrimaryButtonIcon from "@/Components/Buttons/PrimaryButtonIcon.vue";
import FormNumber from "@/Components/FormElements/FormNumber.vue";
import Combobox from "@/Components/Selectors/Combobox.vue";
import { onMounted, ref } from "vue";
import axios, { AxiosResponse } from "axios";

const props = defineProps<{
    product: App.Data.ProductData;
}>();

const title = "Δημιουργία προϊόντος";

const loading = ref<boolean>(true);

const form = useForm<App.Data.ProductData>(
    "post",
    route("product.store"),
    props.product,
);
</script>

<template>
    <Head :title="title" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <Breadcrumbs>
                <Breadcrumb first :href="route('product.index')">
                    Προϊόντα
                </Breadcrumb>

                <Breadcrumb :href="route('product.create')">
                    Δημιουργία
                </Breadcrumb>
            </Breadcrumbs>
        </template>

        <div class="mb-4 flex items-center justify-between">
            <div class="flex flex-col">
                <HeadingLarge> {{ title }}</HeadingLarge>
            </div>

            <div class="flex items-center gap-2">
                <AppLink :href="route('product.index')">
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

                <FormNumber
                    id="price"
                    step="0.1"
                    label="Τιμή"
                    :required="false"
                    :autofocus="false"
                    :error="form.errors.price"
                    v-model="form.price"
                >
                    <PhCurrencyEur weight="bold" />
                </FormNumber>

                <Combobox
                    :route="route('api.category.index')"
                    :min-chars-to-search="2"
                    display-field="name"
                    :multiple="false"
                    v-model="form.category_id"
                    id="Category Selector"
                    label="Κατηγορία"
                    placeholder="Πληκτρολογήστε τουλάχιστον 2 χαρακτήρες για αναζήτηση κατηγορίας..."
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
