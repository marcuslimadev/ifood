# 🗺️ Google Maps API - Configuração Necessária

## ⚠️ Erro: ApiProjectMapError

Se você está vendo o erro `ApiProjectMapError` no console, siga estes passos:

## 1️⃣ Acessar o Google Cloud Console

1. Vá para: https://console.cloud.google.com/
2. Selecione ou crie um projeto
3. Procure pela chave de API: **AIzaSyConSsO9QH4rpNGF42FqA5gk9v9Q61ZxK8**

## 2️⃣ Habilitar as APIs necessárias

No Google Cloud Console, vá para **APIs & Services > Library** e ative:

- ✅ **Maps JavaScript API**
- ✅ **Places API**
- ✅ **Distance Matrix API**
- ✅ **Geocoding API**
- ✅ **Routes API** (para cálculo de distância)

## 3️⃣ Configurar Restrições de API

1. Vá para **APIs & Services > Credentials**
2. Clique na sua chave de API
3. Em **API restrictions**, selecione **Restrict key** e adicione as APIs habilitadas acima
4. Em **Application restrictions**, configure para **HTTP referrers** e adicione seus domínios:
   - `http://localhost` (desenvolvimento)
   - `https://seu-dominio.com` (produção)

## 4️⃣ Problema: Drawing Library Deprecated

A biblioteca Drawing está deprecated. Você verá o aviso:

```
Drawing library functionality in the Maps JavaScript API is deprecated.
This API was deprecated in August 2025 and will be made unavailable in a later version.
```

### Solução:

Remova a biblioteca `drawing` das suas tags de script e use a nova **Maps Marker Clustering** ou **Maps Advanced Markers** quando necessário.

**Atualmente usada em:**
- Zone creation (criação de zonas)
- Restaurant registration (registro de restaurantes)

## 5️⃣ SearchBox também está Deprecated

O aviso indica:

```
As of March 1st, 2025, google.maps.places.SearchBox is not available to new customers.
```

### Solução:

Use **Places Autocomplete Service** ou **Place Autocomplete Widget** em vez de SearchBox.

## 6️⃣ Problema: Firebase Development Build

Remova a versão de desenvolvimento do Firebase. Nos seus templates, substitua:

```html
<!-- ❌ Evitar - Development build -->
<script src="https://www.gstatic.com/firebasejs/5.0.0/firebase.js"></script>

<!-- ✅ Usar - Production build com componentes específicos -->
<script src="https://www.gstatic.com/firebasejs/5.0.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.0/firebase-messaging.js"></script>
```

## 7️⃣ Fixar o carregamento do Google Maps

Adicione `loading=async` em todas as tags de script do Google Maps:

```html
<!-- ❌ Sem loading=async -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&libraries=places"></script>

<!-- ✅ Com loading=async -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&libraries=places&loading=async"></script>
```

## 📋 Checklist Final

- [ ] Verificar se a chave de API está presente em `business_settings` (tabela do banco)
- [ ] Habilitar todas as APIs no Google Cloud Console
- [ ] Configurar restrições de API (HTTP referrers)
- [ ] Remover biblioteca Drawing (ou migrar para API nova)
- [ ] Migrar SearchBox para Autocomplete
- [ ] Usar Firebase production build
- [ ] Adicionar `loading=async` em scripts do Google Maps
- [ ] Testar em desenvolvimento: `http://localhost`

## 🔍 Debug

Para verificar se a chave está sendo carregada corretamente no banco:

```bash
php artisan tinker
>>> \App\Models\BusinessSetting::where('key', 'map_api_key')->first()?->value
```

Isso deve retornar: `AIzaSyConSsO9QH4rpNGF42FqA5gk9v9Q61ZxK8`

Se retornar `null`, execute:

```bash
php artisan db:seed --class=GoogleMapsSeeder
```

## 📞 Referências

- [Google Maps JavaScript API Documentation](https://developers.google.com/maps/documentation/javascript)
- [Migration Guide from Drawing Library](https://developers.google.com/maps/deprecations)
- [Firebase Best Practices](https://firebase.google.com/docs/web/setup)
