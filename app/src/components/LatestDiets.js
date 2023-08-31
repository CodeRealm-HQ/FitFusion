import React, { useState, useEffect } from 'react';
import { View, ImageBackground} from 'react-native';
import Styles from '../config/Styles';
import Loading from './InnerLoading';
import { getLatestDiets } from "../config/DataApp";
import { Text} from 'react-native-paper';
import { LinearGradient } from 'expo-linear-gradient';
import { FlatGrid } from 'react-native-super-grid';
import Languages from '../languages';
import LanguageContext from '../languages/LanguageContext';
import { useNavigation } from '@react-navigation/native';
import TouchableScale from 'react-native-touchable-scale';

export default function LatestWorkouts(props) {

  const [isLoaded, setIsLoaded] = useState(false);
  const [items, setItems] = useState([]);

  const contextState = React.useContext(LanguageContext);
  const language = contextState.language;
  const Strings = Languages[language].texts;

  const navigation = useNavigation();
  
  const onChangeScreen = (id, title) => {
    navigation.navigate('dietdetails', {id, title});
  };

  useEffect(() => {
    getLatestDiets(1, 6).then((response) => {
        setItems(response);
        setIsLoaded(true);
    });
  }, []);


  if (!isLoaded) {
    return (
      <Loading/>
      );
  }

  if (isLoaded) {
    return (
      <View style={{marginHorizontal: 10}}>

        <FlatGrid
        itemDimension={130}
        data={items}
        renderItem={({ item }) => (
    <TouchableScale activeOpacity={1} onPress={() => onChangeScreen(item.id, item.title)} activeScale={0.98} tension={100} friction={10}>
    <ImageBackground source={{uri: item.image}} style={Styles.card4_background} imageStyle={{borderRadius: 8}}>
            <LinearGradient colors={['rgba(0,0,0,0.1)', 'rgba(0,0,0,0.7)']} style={Styles.card4_gradient}>
  
              <View style={Styles.card4_viewicon}>
                  <Text style={{fontSize:12, color: '#fff', opacity:0.8}}>{item.calories} {Strings.ST46}</Text>
              </View>
              <Text numberOfLines={1} style={Styles.card4_title}>{item.title}</Text>
  
            </LinearGradient>
          </ImageBackground>
          </TouchableScale>
        
            )}
        />

      </View>
      );
  }

}