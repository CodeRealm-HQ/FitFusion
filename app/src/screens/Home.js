import React from 'react';
import { View, ScrollView, SafeAreaView } from 'react-native';
import Heading from '../components/Heading';
import LatestWorkouts from '../components/LatestWorkouts';
import ExercisesLibrary from '../components/ExercisesLibrary';
import Goals from '../components/Goals';
import Styles from '../config/Styles';
import Languages from '../languages';
import LanguageContext from '../languages/LanguageContext';
import Levels from '../components/Levels';
import LatestDiets from '../components/LatestDiets';

export default function Home(props) {

  const contextState = React.useContext(LanguageContext);
  const language = contextState.language;
  const Strings = Languages[language].texts;

  const onChangeScreen = (screen) => {
    props.navigation.navigate(screen);
};

 return (
  <ScrollView
  showsHorizontalScrollIndicator={false}
  showsVerticalScrollIndicator={false}
>
    
<SafeAreaView>

    <View style={Styles.HomeScreen}>

        <Heading title={Strings.ST23} button={() => onChangeScreen('workouts')}/>
        <LatestWorkouts/>
        
        <Heading title={Strings.ST22} button={() => onChangeScreen('goals')}/>
        <Goals/>

        <Heading title={Strings.ST24} button={() => onChangeScreen('levels')}/>
        <Levels/>

        <ExercisesLibrary/>

        <Heading title={Strings.ST47} button={() => onChangeScreen('diets')}/>
        <LatestDiets/>

    </View>
    </SafeAreaView>
    </ScrollView>

      );

}

