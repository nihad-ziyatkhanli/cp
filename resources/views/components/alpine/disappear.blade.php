<div {{ $attributes }} x-data="{
    show: false,
    init() {
        setTimeout(() => {
            this.show = true
        }, 50)
        setTimeout(() => {
            this.show = false
        }, {{ $timeout ?? 5000 }})
    }
}" x-show="show" x-transition.duration.1000ms x-cloak>
    {{ $slot }}
</div>
