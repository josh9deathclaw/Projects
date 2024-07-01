from django.urls import path
from .views import HomePageView, ReviewsView, NewsView, WriteView

urlpatterns = [
    path('', HomePageView.as_view(), name='home'),
    path('reviews/', ReviewsView.as_view(), name='reviews'),
    path('news/', NewsView.as_view(), name='news'),
    path('write/', WriteView.as_view(), name='write'),
]