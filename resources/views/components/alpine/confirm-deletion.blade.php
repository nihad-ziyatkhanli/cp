<div x-data="{
    openModalAsDelete($id) {
        this.heading = 'Confirm Deletion';
        this.content = 'Are you sure you want to delete this record?';
        this.action = 'Delete';
        this.act = () => {
            this.$wire.delete($id)
            document.getElementById('closeBasicModal').click();
        };
        document.getElementById('openBasicModal').click();
    }
}">
    {{ $slot }}
</div>
