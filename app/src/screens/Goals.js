import React, { useState, useEffect } from 'react';
import { ScrollView, View, ImageBackground, SafeAreaView } from 'react-native';
import Styles from '../config/Styles';
import { getGoals } from "../config/DataApp";
import {map} from 'lodash';
import AppLoading from '../components/InnerLoading';
import TouchableScale from 'react-native-touchable-scale';
import { Text, IconButton } from 'react-native-paper';
import { LinearGradient } from 'expo-linear-gradient';
import LoadMoreButton from '../components/LoadMoreButton';

export default function Goals(props) {

  const { navigation } = props;
  const [isLoaded, setIsLoaded] = useState(false);
  const [page, setPage] = useState(1);
  const [items, setItems] = useState([]);
  const [showButton, setshowButton] = useState(true);
  const [loading, setLoading] = useState(false);

  const onChangeScreen = (screen) => {
    navigation.navigate(screen);
  };

  const onClickItem = (id, title) => {
    navigation.navigate('singlegoal', {id, title});
  };

  const loadMore = () => {

    setLoading(true);
    setPage(page+1);

    getGoals(page+1).then((response) => {

      if (!items) {
        setItems(response);
        setLoading(false);
      }else{
        setItems([...items, ...response]);
        setLoading(false);
      }

      if (response.length <= 0) {
        setshowButton(false);
      }

      setIsLoaded(true);

    });

  };

  const renderButton = () => {

    return (
      <LoadMoreButton
      Indicator={loading}
      showButton={showButton}
      Items={items}
      Num={5}
      Click={() => loadMore()}/>
      )
  }

  const buttonSearch = () => {
    return (
      <IconButton icon="magnify" size={24} style={{marginLeft:15}} onPress={() => onChangeScreen('searchworkout')}/>
      )
  };

  useEffect(() => {
  
    props.navigation.setOptions({
      headerRight: () => buttonSearch()
    });
  
  }, []);

  useEffect(() => {
    getGoals().then((response) => {
        setItems(response);
        setIsLoaded(true);
    });
  }, []);

  if (!isLoaded) {

    return (
   
        <AppLoading/>
   
         );
   
      }else{

 return (

  <ScrollView
  showsHorizontalScrollIndicator={false}
  showsVerticalScrollIndicator={false}
>
    
<SafeAreaView>

    <View style={Styles.ContentScreen}>

    {map(items, (item, i) => (
    
    <TouchableScale key={i} activeOpacity={1} onPress={() => onClickItem(item.id, item.title)} activeScale={0.98} tension={100} friction={10}>
        <ImageBackground source={{uri: item.image}} style={Styles.background_categories} imageStyle={{borderRadius: 8}}>
            <LinearGradient colors={['rgba(0,0,0,0.1)', 'rgba(0,0,0,0.7)']} style={Styles.gradient_categories}>
            <View style={Styles.title_categories_border}></View>
            <LinearGradient colors={['rgba(0,0,0,0.5)', 'rgba(0,0,0,0.5)']} style={Styles.title_categories_background}>
                    <Text style={Styles.title_categories}>{item.title}</Text>
            </LinearGradient>
            </LinearGradient>
        </ImageBackground>
    </TouchableScale>

          ))}

    {renderButton()}

    </View>
    </SafeAreaView>
    </ScrollView>

      );

}

}


