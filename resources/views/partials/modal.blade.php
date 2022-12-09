<!--button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalId" @click="showModal=true">
    Open modal
</button-->

<modal v-if="showModal">
    <template slot="header">Title</template>
    Content!
    <template slot="buttons">
        <button type="button" class="btn btn-primary">Save</button>
    </template>
</modal>