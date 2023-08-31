import React, { useState, useEffect } from 'react';
import { ScrollView, View, ImageBackground } from 'react-native';
import Styles from '../config/Styles';
import Languages from '../languages';
import LanguageContext from '../languages/LanguageContext';
import { getPostsByTag } from "../config/DataApp";
import {map} from 'lodash';
import AppLoading from '../components/InnerLoading';
import TouchableScale from 'react-native-touchable-scale';
import { Paragraph, Text } from 'react-native-paper';
import { LinearGradient } from 'expo-linear-gradient';
import LoadMoreButton from '../components/LoadMoreButton';
import ColorsApp from '../config/ColorsApp';
import moment from 'moment';
import NoContentFound from '../components/NoContentFound';

export default function SingleTag(props) {

    const contextState = React.useContext(LanguageContext);
    const language = contextState.language;
    const Strings = Languages[language].texts;

  const { route } = props;
  const { navigation } = props;
  const { id, title } = route.params;
  const [page, setPage] = useState(1);
  const [isLoaded, setIsLoaded] = useState(false);
  const [data, setData] = useState([]);
  const [showButton, setshowButton] = useState(true);
  const [loading, setLoading] = useState(false);

  const onClickItem = (id, title) => {
    navigation.navigate('postdetails', {id, title});
  };

useEffect(() => {

  props.navigation.setOptions({
    title:title,
  });

}, []);

  useEffect(() => {

    getPostsByTag(id).then(response => {
        setData(response);
        setIsLoaded(true);
    })

  }, []);

  const loadMore = () => {

    setLoading(true);
    setPage(page+1);

    getPostsByTag(id, page+1).then((response) => {

      if (!data) {
        setData(response);
        setLoading(false);
      }else{
        setData([...data, ...response]);
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
      Items={data}
      Num={10}
      Click={() => loadMore()}/>
      )
  }

  if (isLoaded) {

   return (
    <ScrollView
    showsHorizontalScrollIndicator={false}
    showsVerticalScrollIndicator={false}
    >

    <View style={Styles.ContentScreen}>

        {map(data, (item, i) => (

        <TouchableScale key={i} activeOpacity={1} onPress={() => onClickItem(item.id, item.title)} activeScale={0.98} tension={100} friction={10}>
        <ImageBackground source={{uri: item.image}} style={Styles.card3_background} imageStyle={{borderRadius: 8}}>
          <LinearGradient colors={['rgba(0,0,0,0.1)', 'rgba(0,0,0,0.7)']} style={Styles.card3_gradient}>

          <View style={[Styles.card3_viewicon, {paddingLeft:5, paddingVertical:6}]}>
            <Text style={[Styles.card3_icon, {paddingLeft:0}]}>{item.tag}</Text>
            </View>

            <Paragraph style={Styles.card1_subtitle}>{item.level}</Paragraph>
            <Text numberOfLines={2} style={Styles.card1_title}>{item.title}</Text>
            <Text numberOfLines={1} style={[Styles.card1_title, {color: ColorsApp.PRIMARY, marginVertical:5}]}>{moment(item.date).fromNow()}</Text>

          </LinearGradient>
        </ImageBackground>
        </TouchableScale>

        ))}

        {renderButton()}

        <NoContentFound data={data}/>

    <View style={{height: 50}}></View>

    </View>

    </ScrollView>

    );

 }else{
   return (
     <AppLoading/>
     );
 }

}


