@if ( date(DATE_ATOM) > $offer->subscriptionStartDate->format('Y-m-d\TH:i:sP'))      <!-- subscripcion ha empezado -->
    @if ( date(DATE_ATOM) > $offer->subscriptionEndDate->format('Y-m-d\TH:i:sP') )   <!-- subscripcion ha acabado  -->
        <div class="align-self-end alert alert-danger p-2 subscription" role="alert">
            @php
                $offer->subscribable = false;
                $offer->save();
            @endphp
            {{ __('Inscripción cerrada') }}
        </div>
    @else                                                                            <!-- subscripcion no ha acabado  -->
        <div class="align-self-end alert alert-success p-2 subscription" role="alert">
            @php
                $datetime = new DateTime($offer->subscriptionEndDate);
                $interval = $datetime->diff(new DateTime(now()));
                $offer->subscribable = true;
                $offer->save();
            @endphp
            {{ __('Quedan :days dias, :hours horas y :min minutos para inscribirse',
                [
                    'days'  => $interval->format('%a'),
                    'hours' => $interval->format('%h'),
                    'min'   => $interval->format('%i')
                ])
            }}
        </div>  
    @endif
@else                                                                                <!-- subscripcion no ha empezado -->
    <div class="align-self-end alert alert-warning p-2 subscription" role="alert">
        @php
            $datetime = new DateTime($offer->subscriptionStartDate);
            $interval = $datetime->diff(new DateTime(now()));
            $offer->subscribable = false;
            $offer->save();
        @endphp
        {{ __('Faltan :days dias, :hours horas y :min minutos para inscribirse',
            [
                'days'  => $interval->format('%a'),
                'hours' => $interval->format('%h'),
                'min'   => $interval->format('%i')
            ])
        }}
    </div>                      
@endif